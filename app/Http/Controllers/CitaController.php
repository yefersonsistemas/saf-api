<?php

namespace App\Http\Controllers;

use App\Cite;
use App\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateCiteRequest;
use Illuminate\Http\Request;
use App\Reservation;
Use App\Speciality;
Use App\Employe;
Use App\Schedule;
use App\Person;
use App\User;
use App\Patient;
use App\Surgery;
use Carbon\Carbon;

class CitaController extends Controller
{

    public function __invoke()
    {
        $reservations = Reservation::with('cite')->where('discontinued','!=', null)->get();
        if ($reservations->isNotEmpty()) {
            $reservations->each(function ($reservation)
            {
                if (!is_null($reservation->cite)) {
                    $tiempo = Configuration::where('name','limit')->first();
                    if ($tiempo->value != 'indefinido') {
                        $fechaLimite = Carbon::now()->subMonths(int($tiempo->value));
                        $created_at = Carbon::parse($reservation->cite->created_at);
                        if($created_at->lessThan($fechaLimite)){
                            $reservation->delete();
                        }
                    }
                }
            });
        }
    }

    public function index()
    {
        $reservations = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->get();
        $aprobadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get(); //mostrar las reservaciones solo del dia
        
        $canceladas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('cancel')->get(); //mostrar las reservaciones solo del dia
        
        $reprogramadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('reschedule')->get(); //mostrar las reservaciones solo del dia

        $suspendidas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('discontinued')->get(); //mostrar las reservaciones solo del dia

        return view('dashboard.reception.index', compact('reservations', 'aprobadas', 'canceladas', 'suspendidas', 'reprogramadas'));
    }

    public function create()
    {
        $speciality = Speciality::all();
        return view('dashboard.reception.create', compact('speciality'));
    }

    public function agendadas()
    {
        $reservations = Reservation::with('person')->whereDate('date', Carbon::now()->format('Y-m-d'))
                        ->get(); //mostrar las reservaciones solo del dia

        if ($reservations->isNotEmpty()) {
            $reservations = $reservations->each(function( $reservation){
                $patient = Person::where('id', $reservation->patient_id)->first();
                if ($patient != null) {
                    $reservation->patient = $patient;
                    return $reservation; 
                }
            });
        }
        // dd($reservations);

        return view('dashboard.reception.agendadas', compact('reservations'));
    }

    //quota representa el max de cupos por dia de pacientes 
    public static function create_cite(CreateReservationRequest $request){
        
        $employe = Employe::find($request['doctor_id']);
        $employe->load('schedule'); 
        $fecha = Carbon::parse($request['date'])->locale('en'); 
        //dd($fecha);

        $date = Carbon::parse($request['date'])->Format('Y-m-d'); 
        //dd($date);
        $diaDeReserva = strtolower($fecha->dayName);
        //dd($diaDeReserva);
        $dia = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
        //dd($dia);                  
        $cupos = $dia->quota; //obtengo el valor de quota 
       // dd($cupos);  
        $dia = Reservation::whereDate('date', $date)->get()->count(); //obtengo todos los registros de ese dia y los cuento
       // dd($dia);                                
        if ($employe->person->user->hasRole('doctor')) {  //el empleado debe ser doctor por rol y ocupacion sino no crea

            if ($dia <  $cupos) {

                $patient= Person::where('id', $request['id'])->first();
                //dd($patient);
                //dd($patient->id);
            
                $reservation = Reservation::create([		
                    'date' => $request['date'],
                    'description' => $request['description'],
                    'patient_id' => $request['patient_id'],
                    'person_id' => $request['person_id'],
                    'schedule_id' => $request['schedule_id'],
                    'specialitie_id' => $request['specialitie_id'],
                    'branch_id' => 1,
                ]);
            }
            return response()->json([
                'message' => 'Cita creada',
            ]);

        }else{
            return response()->json([
                'message' => 'No hay cupos',
            ]);
        }
    }
    

    public function only_id(Request $request){  //id q recibe update_cite para poder reprogramar
        $reservation = Reservation::with('speciality', 'person', 'schedule', 'patient')->where('id', $request->id)->first();
        //dd($reservation);

        if (!empty($reservation)) {

            return response()->json([
                'all' =>  $reservation,
            ]);
        }
    }

    public function update_cite(UpdateCiteRequest $request){

        $reservation = Reservation::find($request->id);

        if (is_null($reservation)) {
            return response()->json([
                'message' => 'Cita invalida',
                'reservation' => $reservation,
                'request'   => $request,
            ]);
        }

        // return response()->json([
        //     'message' => $reservation->schedule->employe,
        // ]);
       
        $employe = $reservation->schedule->employe;  
        // $employe->load('schedule');

        $date = Carbon::parse($request['date'])->Format('Y-m-d');

        // return response()->json([
        //     'date' => $date,
        //     'carbon' => $request['date'],
        // ]);

        // return dd(Carbon::parse('2018-06-15 17:34:15.984512', 'UTC')->format('Y-m-d')->dayName);

        $diaDeReserva = strtolower(Carbon::parse($request['date'])->locale('en')->dayName); 
        //dd($diaDeReserva);

        $schedule = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
        // dd($schedule);
        
        if ($schedule == null) {
            return response()->json([
                'message' => 'El doctor no cuenta con ese horario',
                ]);
        }
                                              
        $cupos = $schedule->quota; 

        $dia = Reservation::whereDate('date', $date)->get()->count();
        
        if ($dia <  $cupos) {
        
            $reservation->date = $request->date;
            $reservation->description = $request->description;
            $reservation->patient_id = $request->patient_id;
            $reservation->person_id = $request->person_id;
            $reservation->schedule_id = $request->schedule_id;
            $reservation->specialitie_id = $request->specialitie_id;
            $reservation->reschedule = 'Reprogramado';
        
            if($reservation->save()){
                return response()->json([
                    'message' => 'Cambio de cita satisfactorio',
                ]);
            }else{
                return response()->json([
                    'message' => 'No se pudo actualizar la fecha',
                ]);
            }
        }else{
            return response()->json([
                'message' => 'No hay cupos disponibles para la fecha',
            ]);
        }
    }

    public function delete_cite($id){
        $reservation = Reservation::find($id);

        if(!is_null($reservation)){
           $reservation->delete();
 
                return response()->json([
                'message' => 'Cita eliminada',
                ]);
            }
    }

    public function speciality()
    {
       $speciality = Speciality::with('image')->get();
       //$speciality = Speciality::all();

        return response()->json([
            'speciality' => $speciality,
        ]);
    }

    public function search(Request $request){

        $person = Person::where('dni', $request->dni)->first();

        if (!is_null($person)) {
            return response()->json([
                'person' => $person,
            ]);
        }else{
            return response()->json([
                'message' => 'No encontrado',
            ]);
        }
    }

    public function search_doctor(Request $request){    //medico asociado a una especialidad 
        $speciality = Speciality::with('employe.person', 'employe.image')->where('id', $request->id)->get();

        if (!is_null($speciality)) {

            return response()->json([
                'speciality' => $speciality,
            ]);
        }
    }

    /**
     * 
     * Busca el horario del doctor y 
     * retorna los dias que el tenga disponible
     * 
     */
    public function search_schedule(Request $request){//busca el horario del medico para agendar cita
        $employe = Employe::with('schedule')->where('person_id', $request->person_id)->first();

        if (!is_null($employe)) {
            if (!is_null($employe->schedule)) {
                foreach ($employe->schedule as $schedule) {
                    $date[]  = new Carbon('next ' . $schedule->day);
                    $quota[] = $schedule->quota;
                }

                for ($i = 0; $i < count($date); $i++) {
                    /**
                     * El 12 del ciclo for j,
                     * hace referencia a 12 semanas que es la mayor 
                     * anticipacion a la q se puede tener una cita
                     */
                    for ($j= 0; $j < 12; $j++) { 
                        $citesToday = Reservation::whereDate('date', $date[$i])->where('approved', '!=', null)->get()->count();
                        if ($citesToday < $quota[$i]) {
                            $available[] = array('dia' => $date[$i]->day, 'mes' =>  $date[$i]->month); 
                        }
                        $date[$i] = $date[$i]->addWeek();
                    }
                }

                return response()->json([
                    'employe'       => $employe,
                    'available'     => $available,
                ]);
            }else{
                return response()->json([
                    'message' => 'Medico sin horario',
                ]);
            }
        }else{
            return response()->json([
                'message' => 'Medico no encontrado',
            ]);
        }
    }
}

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
use RealRashid\SweetAlert\Facades\Alert;

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
        $aprobadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get(); 
        
        $canceladas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('cancel')->get(); 
        
        $reprogramadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('reschedule')->get(); 

        $suspendidas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('discontinued')->get();
        $pendientes = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNull('discontinued')->whereNull('reschedule')->whereNull('cancel')->whereNull('approved')->whereNotNull('status')->where('status', 'Pendiente')->get();
        
        // Alert::success('Success Title', 'Success Message');

        return view('dashboard.reception.index', compact('reservations', 'aprobadas', 'canceladas', 'suspendidas', 'reprogramadas', 'pendientes'));
    }

    public function create()
    {
        $specialities = Speciality::all();
        return view('dashboard.reception.create', compact('specialities'));
    }

    public function search_patient(Request $request){

        $person = Person::where('type_dni', $request->type_dni)->where('dni', $request->dni)->first();

        if (!is_null($person)) {
            return response()->json([
                'person' => $person,201
            ]);
        }else{
            return response()->json([
                'message' => 'No encontrado',202
            ]);
        }
    }

    public function strore(CreateReservationRequest $request)
    {
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


    public function search_doctor(Request $request){    //medico asociado a una especialidad 
        $speciality = Speciality::with('employe.person', 'employe.image')->where('id', $request->id)->get();

        if (!is_null($speciality)) {

            return response()->json([
                'speciality' => $speciality,
            ]);
        }
    }

}

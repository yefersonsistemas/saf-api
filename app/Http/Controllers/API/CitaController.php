<?php

namespace App\Http\Controllers\API;

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
use Carbon\Carbon;

class CitaController extends Controller
{
    //quota representa el max de cupos por dia de pacientes 
    public static function create_cite(CreateReservationRequest $request){
        
        $employe = Employe::find($request['doctor_id']);
        $employe->load('schedule'); 
        $fecha = Carbon::parse($request['date']); 

        $date = Carbon::parse($request['date'])->Format('Y-m-d'); 
        //dd($date);
        $diaDeReserva = ucfirst($fecha->dayName);
        //dd($diaDeReserva);
        $dia = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
       // dd($dia);                  
        $cupos = $dia->quota; //obtengo el valor de quota 
       // dd($cupos);  
        $dia = Reservation::whereDate('date', $date)->get()->count(); //obtengo todos los registros de ese dia y los cuento
       // dd($dia);                                
        if ($employe->person->user->hasRole('doctor')) {  //el empleado debe ser doctor por rol y ocupacion sino no crea

            if ($dia <  $cupos) {

                $patient= Patient::where('person_id', $request['patient_id'])->first();
                //dd($patient);
                //dd($patient->id);
            
                $reservation = Reservation::create([		
                    'date' => $request['date'],
                    'description' => $request['description'],
                    'patient_id' => $patient->id,
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
        $reservation = Reservation::with('speciality', 'person', 'schedule', 'patient.person')->where('id', $request->id)->first();
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
            ]);
        }

        // return response()->json([
        //     'message' => $reservation->schedule->employe,
        // ]);
       
        $employe = $reservation->schedule->employe;  
        // $employe->load('schedule');

        $date = Carbon::parse($request['date'])->Format('Y-m-d');

        // return dd(Carbon::parse('2018-06-15 17:34:15.984512', 'UTC')->format('Y-m-d')->dayName);

        $diaDeReserva = ucfirst(Carbon::parse($request['date'])->dayName); 

        $schedule = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();

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

    public function search_schedule(Request $request){//busca el horario del medico para agendar cita
        $employe = Employe::with('schedule')->where('person_id', $request->person_id)->first();
     
        if (!is_null($employe)) {

            return response()->json([
                'employe' => $employe,
            ]);
        }else{
            return response()->json([
                'message' =>'No encontrado',
            ]);
        }
    }
}

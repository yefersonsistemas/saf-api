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
use Carbon\Carbon;

class CitaController extends Controller
{
    //quota representa el max de cupos por dia de pacientes 
    public static function create_cite(CreateReservationRequest $request){
        
        $employe = Employe::find($request['doctor_id']);
        $employe->load('schedule'); 
        $fecha = Carbon::parse($request['date']); 

        $date = Carbon::parse($request['date'])->Format('Y-m-d'); 
        $diaDeReserva = ucfirst($fecha->dayName); 

        $dia = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
                               
        $cupos = $dia->quota; //obtengo el valor de quota 
              
        $dia = Reservation::whereDate('date', $date)->where('status', 'Aprobado')->get()->count(); //obtengo todos los registros de ese dia y los cuento
                                        
        if ($employe->person->user->hasRole('doctor')) {  //el empleado debe ser doctor por rol y ocupacion sino no crea

            if ($dia <  $cupos) {
            
                $reservation = Reservation::create([		
                    'date' => $request['date'],
                    'description' => $request['description'],
                    'patient_id' => $request['patient_id'],
                    'status' => 'Pendiente',
                    'person_id' => $request['person_id'],
                    'schedule_id' => $request['schedule_id'],
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

    public function update_cite(UpdateCiteRequest $request, $id){

        $reservation = Reservation::find($id);

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

        $dia = Reservation::whereDate('date', $date)->where('status', 'Aprobado')->get()->count();
        
        if ($dia <  $cupos) {
        
            $reservation->date = $request->date;
            $reservation->status = 'Cancelado';
            //  $reservation->description = $request->description;
            //  $reservation->person_id = $request->person_id;
            //  $reservation->schedule_id = $request->schedule_id;
        
            if($reservation->save()){
                return response()->json([
                    'message' => 'Cambio de cita satisfactorio',
                ]);
            }else{
                return response()->json([
                    'message' => 'No se pudo actualizarla fecha',
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
        $speciality = Speciality::with('image')->get()->groupBy('id');

        return response()->json([
            'speciality' => $speciality,
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use Carbon\Carbon;
Use App\Pacient;
Use App\Visitor;
Use App\Specilaity;
Use App\Employe;
Use App\Person;
Use App\Schedule;
use App\Http\Requests\CreatePatientRequest;
//use App\Http\Requests\CreateReservationRequest;
use App\Http\Controllers\CitaController;


class ReceptionController extends Controller
{

    public function search(Request $request){
       // $visitor = Visitor::all()->dd();
        $person = Person::where('dni', $request)->first(); //busco a ver si existe la persona

        if ($person != null) {  //si existe

            return response()->json([
                'person_id' => $visitor,
            ], 201);
       
        }else{  //caso de que no exista
            return response()->json([
                'message' => 'No encontrado',
            ], 201);
        }
    }

    public function create_history(CreatePatientRequest $request){

        $patient = Patient::create([  //
            'date'               => $request['date'],
            'history_number'     => $request['history_number'],
            'person_id'          => $request['person_id'],
            'gender'             => $request['gender'],
            'place'              => $request['place'],
            'birthdate'          => $request['birthdate'],
            'age'                => $request['age'],
            'weight'             => $request['weight'],
            'occupation'         => $request['occupation'],
            'profession'         => $request['profession'],
            'provious_surgery'   => $request['provious_surgery'],
            'employe_id'         => $request['employe_id'],
            'reason'             => $request['reason'],
            'another_phone'      => $request['another_phone'],
            'another_email'      => $request['another_email'],
            'branch_id'          => 1
        ]);

        return response()->json([
            'message' => 'Paciente creado exitosamente',
        ], 201);
        
    }

    public function cite(){ //crear cita
        CitaController::create_cite();
    }

    // //quota representa el max de cupos por dia de pacientes 
    // public function create_cite(CreateReservationRequest $request){
    //     $speciality = Speciality::all();
    //     $employe = Employe::where('id', $request->id)->first();
    //     $cupos = Schedule::where('quota', $request->quota)->count()->fisrt(); //obtengo la cantidad de registros en quota 
    //     $dia = Reservation::whereDate('date', Carbon::date()->format('d/m/Y'))->get()->count(); //obtengo todos los registros de ese dia y los cuento

    //     if ($employe->position == 'doctor') {

    //         if ($dia < $cupos) {
            
    //             $reservation = Reservation::create([		
    //             'date' => $request->date,
    //             'description' => $request->description,
    //             'status' => $request->status,
    //             'schedule_id' => $request->schedule_id,
    //         ]);
    //         }
    //         return response()->json([
    //             'message' => 'Cita creada',
    //         ], 201);

    //     }else{
    //         return response()->json([
    //             'message' => 'No hay cupos',
    //         ], 201);
    //     }
    // }
}

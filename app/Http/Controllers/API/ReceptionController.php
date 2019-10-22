<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use Carbon\Carbon;
Use App\Patient;
Use App\Person;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdateStatusCiteRequest;


class ReceptionController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with('person')->whereDate('date', Carbon::now()->format('Y-m-d'))
                        ->where('status','Aprobado')->get(); //mostrar las reservaciones solo del dia
        $reservations = $reservations->each(function( $reservation){
            $patient = Person::where('id', $reservation->patient_id)->first();
            $reservation->patient = $patient;
            return $reservation; 
        });
        
        // dd($reservations);
        return response()->json([
            'reservations' => $reservations,
        ]);
    }

    public function search(Request $request)
    {
        $person = Person::where('dni', $request->dni)->first(); //busco a ver si existe la persona

        if (!is_null($person)) {  //si existe

            return response()->json([
                'person' => $person,
            ]);
        }
    }

    public function create_history(CreatePatientRequest $request)
    {
        $patient = Patient::create([  
            'date'               => $request['date'],
            'history_number'     => $request['history_number'],
            'reason'             => $request['reason'],
            'person_id'          => $request['person_id'],
            'gender'             => $request['gender'],
            'place'              => $request['place'],
            'birthdate'          => $request['birthdate'],
            'age'                => $request['age'],
            'weight'             => $request['weight'],
            'occupation'         => $request['occupation'],
            'profession'         => $request['profession'],
            'previous_surgery'   => $request['provious_surgery'],
            'employe_id'         => $request['employe_id'],
            'another_phone'      => $request['another_phone'],
            'another_email'      => $request['another_email'],
            'branch_id'          => 1
        ]);

        return response()->json([
            'message' => 'Paciente creado exitosamente',
        ]);
        
    }

    public function status_change(UpdateStatusCiteRequest $request, $id){
      
        $reservation = Reservation::find($id);
        
        if (!empty($reservation)) {
          
            $reservation->status = $request->status;
    
            if ($reservation->save()){
                return response()->json([
                    'message' => 'Cita cancelada',
                ]);
            }
        }else{
            return response()->json([
                'message' => 'No se pudo cancelar la cita',
            ]);
        }
    }
}

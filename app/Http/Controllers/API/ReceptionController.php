<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use Carbon\Carbon;
Use App\Patient;
Use App\Visitor;
Use App\Specilaity;
Use App\Employe;
Use App\Person;
Use App\Schedule;
use App\Http\Requests\CreatePatientRequest;


class ReceptionController extends Controller
{

    public function index()
    {
        $reservations = Reservation::whereDate('date', Carbon::now()->format('Y-m-d'))->where('status','Aprobado')->get(); //mostrar las reservaciones solo del dia
        $all = collect([]);

        $patients = $reservations->map(function ($item) {
            $item->person;
            return $item->person;
        });
        
        $all = $patients;        

        return response()->json([
            'patients' => $all,
        ]);
    }

    public function search(Request $request)
    {
        $person = Person::where('dni', $request->dni)->first(); //busco a ver si existe la persona
        $history = Patient::where('history_number', $request->history_number);

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
}

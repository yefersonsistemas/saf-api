<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use Illuminate\Http\Request;
use App\Reservation;
Use App\Specilaity;
Use App\Employe;
Use App\Schedule;

class CitaController extends Controller
{
    //quota representa el max de cupos por dia de pacientes 
    public static function create_cite(CreateReservationRequest $request){
        $speciality = Speciality::all();
        $employe = Employe::where('id', $request->id)->first();
        $cupos = Schedule::where('quota', $request->quota)->count()->fisrt(); //obtengo la cantidad de registros en quota 
        $dia = Reservation::whereDate('date', Carbon::date()->format('d/m/Y'))->get()->count(); //obtengo todos los registros de ese dia y los cuento

        if ($employe->position == 'doctor') {

            if ($dia < $cupos) {
            
                $reservation = Reservation::create([		
                'date' => $request->date,
                'description' => $request->description,
                'status' => $request->status,
                'schedule_id' => $request->schedule_id,
            ]);
            }
            return response()->json([
                'message' => 'Cita creada',
            ], 201);

        }else{
            return response()->json([
                'message' => 'No hay cupos',
            ], 201);
        }
    }
}
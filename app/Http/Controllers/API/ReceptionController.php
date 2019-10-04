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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::WhereDate('date', Carbon::now()->format('d/m/Y'))->get(); //mostrar las reservaciones solo del dia
    
        return response()->json([
            'reservation' => $reservations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search($request){
       // $visitor = Visitor::all()->dd();
        $visitor = Visitor::where('person_id', $request)->first(); //busco a ver si existe la persona

        if ($visitor->person->isNotEmpty()) {  //si existe

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
            'person_id'          => $person->person_id,
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

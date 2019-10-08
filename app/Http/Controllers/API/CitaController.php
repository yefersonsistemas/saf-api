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
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    //quota representa el max de cupos por dia de pacientes 
    public static function create_cite(CreateReservationRequest $request){
        $speciality = Speciality::all();
        $employe = Employe::find($request['doctor_id']);
        //$employe->load('schedule');
        $fecha = Carbon::parse($request['date']);

        $date = Carbon::parse($request['date'])->Format('Y-m-d');
        $diaDeReserva = ucfirst($fecha->dayName);

        $dia = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();

        $cupos = $dia->quota; //obtengo el valor de quota 

        $dia = Reservation::whereDate('date', $date)->where('status', 'Aprobado')->get()->count(); //obtengo todos los registros de ese dia y los cuento
       
        if ($employe->person->user->hasRole('doctor')) {

            if ($dia <  $cupos) {
            
                $reservation = Reservation::create([		
                    'date' => $request['date'],
                    'description' => $request['description'],
                    'status' => 'Pendiente',
                    'person_id' => $request['person_id'],
                    'schedule_id' => $request['schedule_id'],
                    'branch_id' => 1,
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

    public function update_cite(UpdateCiteRequest $request, $id){

        $reservation = Reservation::find($id); 
       
        $employe = Employe::find($request['doctor_id']);  
        $employe->load('schedule');
        $fecha = Carbon::parse($request['date']);

        $date = Carbon::parse($request['date'])->Format('Y-m-d'); 
        $diaDeReserva = ucfirst($fecha->dayName); 

        $dia = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
                                              
        $cupos = $dia->quota; 

        $dia = Reservation::whereDate('date', $date)->where('status', 'Aprobado')->get()->count();
        
        if (!is_null($reservation)){
            if ($dia <  $cupos) {
            
                $reservation->date = $request->date;
                // $reservation->description = $request->description;
                // $reservation->person_id = $request->person_id;
                // $reservation->schedule_id = $request->schedule_id;
            
                if($reservation->save()){
                    return response()->json([
                       // 'reservation'  => $reservation,
                        'message' => 'Cambio de cita satisfactorio',
                    ]);
                }
            }
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
}

<?php

namespace App\Http\Controllers\;

use App\Cite;
use App\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Reservation;
use Illuminate\Http\Request;
Use App\Speciality;
Use App\Employe;
Use App\Schedule;
use App\Person;
use App\User;
use App\Patient;
use App\Surgery;
use App\Itinerary;
use App\Doctor;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class SurgerysController extends Controller
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
        $surgeries = Typesurgery::all();
        return view('dashboard.checkout.programar_cirugia', compact('surgeries'));
    }

    public function search_patients(Request $request){

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReservationRequest $request)
    {

        if ($request->person == 'nuevo') {
            $person = Person::create([
                'type_dni'  => $request->type_dni,
                'dni'       => $request->dni,
                'name'      => $request->name,
                'lastname'  => $request->lastname,
                'address'   => $request->address,
                'phone'     => $request->phone,
                'email'     => $request->email,
                'status'    => 'Pendiente',
                'branch_id' => 1
            ]);

            $request->person = $person->id;
        }
        $dia = strtolower(Carbon::create($request->date)->locale('en')->dayName);

        $schedule = Schedule::where('employe_id',$request->doctor)->where('day', $dia)->first();

        $date = Carbon::create($request->date);

        $reservation = Reservation::create([		
            'date' => $date,
            'description' => $request->motivo,
            'patient_id' => $request->person,
            'person_id' => $request->doctor,
            'schedule_id' => $schedule->id,
            'status'      => 'Pendiente',
            'surgerie_id' => $request->surgery,
            'branch_id' => 1,
        ]);

        return $reservation;

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
    
}

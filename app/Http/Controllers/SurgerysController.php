<?php

namespace App\Http\Controllers;

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
use App\Typesurgery;
use App\Itinerary;
use App\Doctor;
use App\Area;
use App\TypeArea;
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
    // para agendar cirugia cuando el paciente se encuentra en el itinerario 
    public function create($id){
        // dd($id);
        $tipo = TypeArea::where('name', 'Quirofano')->first();

        $quirofano = Area::with('typearea','image')->where('type_area_id', $tipo->id)->get();     
        //aqui trae los datos asociados al parametro(cuando el paciente agenda el dia que fue candidato a cirugia)
        $paciente = Itinerary::with('person','typesurgery')->where('id',$id)->first();
        // dd($paciente);
        $medico = Typesurgery::with('employe_surgery.person.image')->where('id', $paciente->typesurgery->id)->first();

        // dd($medico);
        return view('dashboard.checkout.programar_cirugia', compact('quirofano', 'paciente', 'medico'));
}

// para agendar cirugia cuando el paciente no se encuentra en el itinerario
public function create_surgery(){

    // $cirugias = Surgery::all();
    // dd($cirugias);
    $surgeries = Typesurgery::all();
    $tipo = TypeArea::where('name', 'Quirofano')->first();
    $quirofano = Area::with('image')->where('type_area_id', $tipo->id)->get();     

    return view('dashboard.checkout.programar-cirugia', compact('surgeries', 'quirofano', 'cirugias'));
}

    
    //buscar paciente
    public function search_patients_out(Request $request){

        // dd($request);
        $person = Person::where('type_dni', $request->type_dni)->where('dni', $request->dni)->first();
        // dd($person);
        $patient = Patient::with('person')->where('person_id', $person->id)->first();
        // dd($patient);
        if (!is_null($patient)) {
            // $patient = Patient::with('person')->where('person_id', $person->id)->first();
            return response()->json([
            'patient' => $patient, 201
            ]);
        }else{
            return response()->json([
                'message' => 'No encontrado',202
            ]);
        }
    }


    public function search_doctor(Request $request){    //medicos asociado a una cirugia
        
        $surgery = Typesurgery::with('employe_surgery.person', 'employe_surgery.image','employe_surgery.person.image')->where('id', $request->id)->first();
        // dd($surgery);
        if (!is_null($surgery)) {

            return response()->json([
                'surgery' => $surgery,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //agenda la cirugia
    public function store(Request $request)
    {   
        // dd($request);
        //datos a guardar en la tabla surgeries
        $p = Patient::where('person_id',$request->patient_id)->first(); //tabla trayendo id del paciente
        // dd($p);
        $ts = $request->type_surgery_id;
        $e = $request->employe_id;
        $a = $request->area_id;
        $d = Carbon::create($request->date)->format('Y-m-d');

        
        // dd($patient);
        if($p !=null && $ts !=null && $e !=null && $a !=null && $d !=null){
            
            $surgery = Surgery::create([		
                'patient_id' => $p->id,
                'type_surgery_id' => $ts,
                'employe_id' => $e,
                'area_id' => $a,
                'date'=> $d,
                'branch_id' => 1,
                ]);

                //Actualiza el status del quirofano a ocupado
                $a = Area::find($request->area_id);
                
                if (!empty($a)) {
                    
                    $a->status = 'ocupado';
                    $a->save();
                }
                //actualizando el campo opertion de la tabla reservation
                $operation = Reservation::find($request->reservation_id);
                $operation->operation = true;
                $operation->save();

                $surgery->patient()->attach($p);
                // $surgery->reservation()->attach($operation);

            return redirect()->route('checkout.index')->withSuccess('Cirugia Agendada Exitosamente!');

        }else{
            return redirect()->back()->withError('Cirugia no Agendada!');
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

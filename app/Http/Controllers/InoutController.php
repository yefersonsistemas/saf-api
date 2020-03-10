<?php

namespace App\Http\Controllers;

use App\Area;
use App\Billing;
use App\ClassificationSurgery;
use App\Itinerary;
use App\Patient;
use App\Person;
use App\Procedure;
use App\Reservation;
use App\Surgery;
use App\TypeArea;
use App\Typesurgery;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutEvents;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class InoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $day = Surgery::with('patient.person.image','typesurgeries','area','employe')->get();

       return view('dashboard.vergel.in-out.index',compact('day'));
    }



    public function agendar_cirugia()
    {
        $clasificacion = ClassificationSurgery::where('name', 'hospitalaria')->first();
       //dd($clasificacion);
        $surgery = Typesurgery::with('image')->where('classification_surgery_id', $clasificacion->id)->get();
        //  dd($surgery);
        $tipo = TypeArea::where('name', 'Quirofano')->first();
        //dd($tipo);
        $area = Area::with('image')->where('type_area_id', $tipo->id)->get();
        return view('dashboard.vergel.in-out.agendar_cirugia', compact('surgery','area'));
    }





    public function facturacion()
    {

        return view('dashboard.vergel.in-out.facturacion');

    }

    public function factura()
    {

        return view('dashboard.vergel.in-out.factura');

    }

    public function imprimir_factura()
    {
    return view('dashboard.vergel.in-out.imprimir_factura');

    }
    public function day(){

    $day = Surgery::with('patient.person.image','typesurgeries','area','employe')->get();
    // dd($day);
    return view('dashboard.vergel.in-out.day',compact('day'));
    }

    //-----------------------buscar paciente para inout desde person-----------------------------

    public function search_patients_inout(Request $request){

        // dd($request);
        $person = Person::with('image')->where('type_dni', $request->type_dni)->where('dni', $request->dni)->first();
        // dd($person);

        if (!is_null($person)) {
            $patient = Patient::with('person.image')->where('person_id', $person->id)->first();
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
        }else{
            return response()->json([
                'message' => 'Persona no registrada',202
            ]);
        }
    }

    //============================ buscanco paciente desde la tabla citugia ============================
    public function search_patients_cirugia (Request $request){  // asi se llama adelante inout.search_patients

        if(!empty($request->dni)){

            $person = Person::where('dni', $request->dni)->first();
            $patient = Patient::where('person_id', $person->id)->first();
                // dd($patient);

            if(!empty($patient)){

                $surgery = Surgery::where('patient_id', $patient->id)->first();

                // dd($surgery);

                if(!empty($surgery)){

                    if(!empty($surgery->patient_id)){

                        // $patient = Patient::find($surgery->patient_id);
                            // dd($patient);

                        if(!empty($patient)){

                            $all = collect([]); //definiendo una coleccion|
                            $encontrado = Surgery::with('patient.person', 'employe.person','typesurgeries')->where('patient_id', $patient->id)->get(); // esta es una coleccion

                            if (!is_null($encontrado)) {
                                return response()->json([
                                    'encontrado' => $encontrado,201,
                                    // 'procedureS'  => $procedureS,
                                ]);
                            }else{
                                return response()->json([
                                    'encontrado' => 'persona no encontrado', 202
                                ]);
                            }
                        }
                    }else{
                        $all = collect([]); //definiendo una coleccion|
                        $encontrado = Surgery::with('patient.person', 'employe.person','typesurgeries')->where('patient_id', $patient->id)->get(); // esta es una coleccion
                        // dd($encontrado);

                        if (!is_null($encontrado)) {
                            return response()->json([
                                'encontrado' => $encontrado,201,
                            ]);
                        }else{
                            return response()->json([
                                'encontrado' => 'persona no encontrado', 202
                            ]);
                        }
                    }
                }else{
                    return response()->json([
                        'encontrado' => 'paciente no encontrado', 202
                    ]);
                }
                    }else{
                        return response()->json([
                            'encontrado' => 'paciente no registrado',202
                        ]);

                        }

                // cuando viene vacio el imput de cedula

            }
            // else{
            //     return response()->json([
            //         'encontrado' => 'Debe ingresar un valor de busqueda',202
            //     ]);
            // }
    }


//---------------------------fin del metodo buscar para facturacion de cirugia----------------------------------------


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surgery = Surgery::with('patient.person','employe.person','employe.doctor', 'typesurgeries')->where('patient_id', $patient->id)->first();
        // dd($surgery);
        $fecha = Carbon::now()->format('Y-m-d');
// dd($fecha);

        //----- para el precio de la corigia----
        $total_S=0;
        if(!empty($surgery->typesurgeries)){
            $total_S = $surgery->typesurgeries->cost;
        }else{
            $total_S = null;
            // dd($total_S);
        }

        //---------precio de la consulta--------
        $total_C=0;
        if($si == true){
            $total_C = $itinerary->employe->doctor->price;
        }

        $total = $total_P + $total_S + $total_C;


        return view('dashboard.checkout.facturacionf', compact('procedimientos','fecha','itinerary','procedureS','total'));
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
}

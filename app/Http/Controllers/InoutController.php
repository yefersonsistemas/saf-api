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
        $surgery = Typesurgery::with('image')->where('classification_surgery_id',  $clasificacion->id)-> get();
        $tipo = TypeArea::where('name', 'Quirofano')->first();
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
        // dd($person); 

        if(!empty($person)){

            $patient = Patient::with('person')->where('person_id', $person->id)->first();
 
            // dd($patient);     
            
            if(!empty($patient)){

                if(!empty($surgery->billing_id)){

                    $billing = Billing::find($surgery->billing_id);

                    dd($$billing->person_id );
                                                                            
                    if(!empty($billing->person_id)){

                                                                            
                    return response()->json([
                        'pago' => 'Pago', 300
                    ]);
                   
                    }else{
                        $all = collect([]); //definiendo una coleccion|
                        $encontrado = Surgery::with('patient.person', 'employe.person','typesurgery')->where('patient_id', $person->id)->get(); // esta es una coleccion
                        //dd($encontrado);
                        $type_surgeries = explode(',', $encontrado->last()->procedureR_id); //decodificando los procedimientos en $encontrado
    
                        if($procedures[0] != ''){ 
                            foreach ($encontrado as $proce) {  //recorriendo el arreglo de procedimientos
                            $procedures[] = $proce->procedureR_id;
                            }
    
                            for ($i=0; $i < count($procedures)-1 ; $i++) {          //buscando datos de cada procedimiento
                                $procedureS[] = Procedure::find($procedures[$i]);
                            }
                            
                            $all->push($procedureS);  // colocando los procedimientos en colas ordenados
                        }else{
                            $procedureS = null;
                        }
    
                        if (!is_null($encontrado)) {
                            return response()->json([
                                'encontrado' => $encontrado,201,
                                'procedureS'  => $procedureS,
                            ]);
                        }else{
                            return response()->json([
                                'encontrado' => 'persona no encontrado', 202
                            ]);
                        }
    
                    }
                    
                }else{
                    $all = collect([]); //definiendo una coleccion|
                    $encontrado = Itinerary::with('person', 'employe.person', 'procedure','employe.doctor','surgeryR')->where('patient_id', $person->id)->get(); // esta es una coleccion
                    // dd($encontrado);
                    $procedures = explode(',', $encontrado->last()->procedureR_id); //decodificando los procedimientos en $encontrado

                    if($procedures[0] != ''){ 
                        foreach ($encontrado as $proce) {  //recorriendo el arreglo de procedimientos
                        $procedures[] = $proce->procedureR_id;
                        }

                        for ($i=0; $i < count($procedures)-1 ; $i++) {          //buscando datos de cada procedimiento
                            $procedureS[] = Procedure::find($procedures[$i]);
                        }
                        
                        $all->push($procedureS);  // colocando los procedimientos en colas ordenados
                    }else{
                        $procedureS = null;
                    }

                    if (!is_null($encontrado)) {
                        return response()->json([
                            'encontrado' => $encontrado,201,
                            'procedureS'  => $procedureS,
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
                        'encontrado' => 'paciente no  registrado',202
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
}

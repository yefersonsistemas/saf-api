<?php

namespace App\Http\Controllers;

use App\Area;
use App\Patient;
use App\Person;
use App\Surgery;
use App\TypeArea;
use App\Typesurgery;
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
     $surgery = Typesurgery::with('image')-> get();
     $area = TypeArea::with('image') ->get();
     
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

    //-----------------------buscar paciente para inout-----------------------------

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

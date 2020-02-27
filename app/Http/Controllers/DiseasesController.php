<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Patient;
use App\Reservation;
use Illuminate\Http\Request;

class DiseasesController extends Controller
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
        return view('dashboard.director.disease');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $disease = Disease::create([
            'name' => $data['name'],
            'branch_id' => 1
        ]);

        return redirect()->back()->withSuccess('Registro creado correctamente');
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
        $disease = Disease::find($id);

        return view('dashboard.director.disease-edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $disease = Disease::find($request->id);

        $disease->name = $request->name;
        $disease->update();

        return redirect()->route('all.register')->withSuccess('Registro modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disease = Disease::find($id);
        $disease->delete();
        return redirect()->route('all.register')->withSuccess('Enfermedad eliminada');
    }



    //============= agregar enfermedad =============
    public function agregar_enfermedad(Request $request){

        $returndata2 = array();
        $strArray = explode('&', $request->data);

        foreach($strArray as $item) {
            $array = explode("=", $item);
            $returndata[] = $array;
        }

        for($i=0; $i < count($returndata); $i++){
            for($y=1; $y <= 1; $y++){
            $returndata2[$i] = $returndata[$i][$y];
            }
        }

        $reservation = Reservation::with('patient.historyPatient.disease')->where('id',$request->id)->first();
        $patients = Patient::where('person_id', $reservation->patient->id)->first();

        $enfermedades = Disease::all();
        $array1=array();
        if($reservation->patient->historyPatient->disease->first() != null){
            foreach($reservation->patient->historyPatient->disease as $item){
                $array1[] = $item->id;
            }
        }

        if($array1 != []){
            $merge_enfermedad= array_merge($returndata2,$array1);
            $diff = array_diff($returndata2,$array1);
        }else{
            $merge_enfermedad = $returndata2;
            $diff = $returndata2;
        }

        //guardando examens en la tabla diagnostic_exam
        foreach($merge_enfermedad as $item){
            $b_enfermedad = Disease::find($item);
            $b_enfermedad->patient()->sync($patients);
        }

        foreach($diff as $item){
            $enfermedad[] = Disease::find($item);
        }

        return response()->json([
            'enfermedad' => 'Enfermedad agregada exitosamente',201,$enfermedad
            ]);
    }


    //===================eliminar enfermedades ==========================
    public function enfermedad_eliminar(Request $request){

        $reservation = Reservation::find($request->reservacion_id);

        $disease = Disease::find($request->id);

        $patient = Patient::where('person_id',$reservation->patient_id)->first();

        $disease->patient()->detach($patient);

        return response()->json([
            'enfermedad' => 'Enfermedad eliminada correctamente',202,$disease
        ]);
    }

    public function diseases_create(Request $request){ //Metodo para crear enfermedad si no existe en el multiselect de editar historia
        $patient = Patient::where('person_id', $request->id)->first();
        $data = $request->validate([
            'name' => 'required',
            ]);
            
        $disease = Disease::create([
            'name' => $data['name'],
            'branch_id' => 1
            ]);
        // guardar en tabla pivote con el registro de paciente y enfermedad

        $disease->patient()->attach($patient);
        // Enviar el registro de enfermedad 
        return response()->json([
            'data' => 'Enfermedad Agregada',$disease,201
            ]);
    }

}

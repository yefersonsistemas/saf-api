<?php

namespace App\Http\Controllers;

use App\Allergy;
use App\Reservation;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllergyController extends Controller
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
        return view('dashboard.director.allergy');
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

        $allergy = Allergy::create([
            'name' => $data['name'],
            'branch_id' => 1
        ]);

        return redirect()->back()->withSuccess('Registro agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function show(Allergy $allergy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($allergy);
        $allergy = Allergy::find($id);
        // dd($allergy);
        return view('dashboard.director.allergy-edit', compact('allergy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $allergy = Allergy::find($request->id);
        
        $allergy->name = $request->name;
        $allergy->update();
        // dd($allergy);

       return redirect()->route('all.register')->withSuccess('Registro modificado'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allergy = Allergy::find($id);
        $allergy->delete();
        return redirect()->route('all.register')->withSuccess('Alergia eliminada');
    }


    //============= agregar alergias a la historia en el doctor =============
    public function agregar_alergias(Request $request){

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
        // dd($returndata2);

        $reservation = Reservation::with('patient.historyPatient.allergy')->where('id',$request->id)->first();
        // dd($reservation->patient->historyPatient->id);
        $patients = Patient::where('person_id', $reservation->patient->id)->first();

        $alergias = Allergy::all();
        $array1=array();
        if($reservation->patient->historyPatient->allergy->first() != null){
            foreach($reservation->patient->historyPatient->allergy as $item){
                $array1[] = $item->id;
            }
        }

        if($array1 != []){
            $merge_alergias= array_merge($returndata2,$array1);
            $diff = array_diff($returndata2,$array1);
        }else{
            $merge_alergias = $returndata2;
            $diff = $returndata2;
        }

        //guardando examens en la tabla diagnostic_exam
            foreach($merge_alergias as $item){
                $b_alergia = Allergy::find($item);
                $b_alergia->patient()->sync($patients);
            }

            foreach($diff as $item){
                $alergia[] = Allergy::find($item);
            }

            // dd($alergia);
        return response()->json([
            'enfermedad' => 'Alergia agregada exitosamente',201,$alergia
            ]);
    }

    //===================eliminar alergia ==========================
    public function alergia_eliminar(Request $request){

        $reservation = Reservation::find($request->reservacion_id);

        $b_alergia = Allergy::find($request->id);

        $patient = Patient::where('person_id',$reservation->patient_id)->first();

        $b_alergia->patient()->detach($patient);
        // dd($alergia);

        return response()->json([
            'alergia' => 'Alergia eliminada correctamente',202,$b_alergia
        ]);
    }

}

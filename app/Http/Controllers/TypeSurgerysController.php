<?php

namespace App\Http\Controllers;

use App\ClassificationSurgery;
use App\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Reservation;
use App\Itinerary;
use App\Procedure;
Use App\Typesurgery;



class TypeSurgerysController extends Controller
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
        $classification = ClassificationSurgery::get();
        $procedure = Procedure::get();

        return view('dashboard.director.surgery', compact('classification', 'procedure'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $data =  $request->validate([
            'name'   => 'required',
            'duration' => 'required',
            'cost'   => 'required',
            'description' => 'required',
            'classification_surgery_id' => 'required',
            'day_hospitalization' => 'required',
            'cost.required' => 'Es obligatorio precio de la cirugía.',
        ]);

        $surgery =  Typesurgery::create([
            'name'                        => $data['name'],
            'duration'                    => $data['duration'],
            'cost'                        => $data['cost'],
            'description'                 => $data['description'],
            'classification_surgery_id'   => $request->classification_surgery_id,
            'day_hospitalization'         => $request->day_hospitalization,
            'branch_id'                   => 1
        ]);

        if (!is_null($surgery)) {
            if (!empty($request->procedure)) {
                foreach ($request->procedure as $procedure) {
                    $procedimiento = Procedure::find($procedure);
                    $surgery->procedure()->attach($procedimiento); 
                }
            }
        }

        return redirect()->back()->withSuccess('Registro agregado correctamente');
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
        $classification = ClassificationSurgery::get();
        $procedure = Procedure::get();
        $surgery = Typesurgery::with('procedure', 'classification')->find($id);

        $diff_procedure = $procedure->diff($surgery->procedure);

        $buscar_clasificacion = ClassificationSurgery::where('id', $surgery->classification_surgery_id)->first();
        $clasi = array($buscar_clasificacion);
        $diff = $classification->diff($clasi);

        return view('dashboard.director.surgery-edit', compact('classification', 'procedure', 'diff_procedure','surgery', 'buscar_clasificacion', 'diff'));
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
        // dd($request);
        $surgery = Typesurgery::with('classification', 'procedure')->find($request->id);

        $surgery->name = $request->name;
        $surgery->duration = $request->duration;
        $surgery->cost = $request->cost;
        $surgery->description = $request->description;
        $surgery->classification_surgery_id = $request->classification_surgery_id;
        $surgery->day_hospitalization =  $request->day_hospitalization;
        $surgery->update();

        $surgery->procedure()->sync($request->procedure);

        return redirect()->route('all.register')->withSuccess('Cirugía modificada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Typesurgery::find($id);
        $type->delete();
        return redirect()->route('all.register')->withSuccess('Cirugía eliminada');
    }

    public function surgeries(Request $request){  //lista de todas las cirugias
        $s = TypeSurgery::get();

        if(!is_null($s)){
            return response()->json([
                'surgeries' => $s,
            ]);
        }
    }

    public function type_surgery()
    {
        $s = ClassificationSurgery::get();

        if(!is_null($s)){
            return response()->json([
                'tpesurgeries' => $s,
            ]);
        }
    }

    /**
     * tipo de cirugía
     */

    public function create_classification()
    {
        return view('dashboard.director.type-surgery');
    }


    public function store_classification(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $classification = ClassificationSurgery::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'branch_id' => 1
        ]);

        return redirect()->route('all.register')->withSuccess('Registro agregado correctamente');
    }

    public function edit_classification($id)
    {
        $classification = ClassificationSurgery::find($id);
        return view('dashboard.director.type-surgery-edit', compact('classification'));
    }


    public function update_classification(Request $request)
    {
        $classification = ClassificationSurgery::find($request->id);

        $classification->name = $request->name;
        $classification->description = $request->description;
        $classification->update();
           

        return redirect()->route('all.register')->withSuccess('Tipo de cirugía modificada');
    }

    public function destroy_cirugia($id)
    {
        $classification = ClassificationSurgery::find($id);
        $classification->delete();
        return redirect()->route('all.register')->withSuccess('Tipo de cirugía eliminada');
    }


    //============= agregar cirugias a la historia en el doctor =============
    public function agregar_cirugias(Request $request){

        $reservation = Reservation::find($request->id);

        $cirugia = Patient::where('person_id', $reservation->patient_id)->first();
        // dd($cirugia);
        if($cirugia != null){
            $cirugia->previous_surgery = $request->data;
            $cirugia->save();
        }else{
            $cirugia = null;
        }

        return response()->json([
            'Cirugia' => 'Cirugia agregada exitosamente',201,$cirugia
            ]);
    }

    //============== guardando Candidato a cirugias===============
    public function surgerysP(Request $request){

        $itinerary = Itinerary::where('reservation_id', $request->id)->first();

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
        $data =  implode(',', $returndata2);

        // dd($returndata2);
        $itinerary->typesurgery_id = $data;
        $itinerary->save();

        $surgerys = explode(',', $itinerary->typesurgery_id); // decodificando los prcocedimientos json

        for ($i=0; $i < count($surgerys) ; $i++) {
                    $surgery[] = TypeSurgery::with('classification')->find($surgerys[$i]);
                }

        return response()->json([
            'surgerysR' => 'Cirugias guardadas exitosamente',201,$surgery
        ]);
    }

    //===================== actualizar Candidato a cirugias ====================
    public function surgerysP_update(Request $request){

        $itinerary = Itinerary::where('reservation_id', $request->id)->first();

        $returndata2 = array();
        if(!empty($request->data)){
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

            if($itinerary->typesurgery_id != $returndata2[0]){
                $surgery[] = TypeSurgery::with('classification')->find($returndata2[0]);
            }else{
                $surgery[] = null;
            }

            $itinerary->typesurgery_id = $returndata2[0];
            $itinerary->save();

            return response()->json([
                'surgerysR' => 'Cirugias guardadas exitosamente',201,$surgery
            ]);
        }else{
            return response()->json([
                'surgerysR' => 'Seleccione una cirugia',202
            ]);
        }
    }

    //================eliminar posibles procedimientos ===================
    public function cirugiaP_eliminar2(Request $request){

        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();

        $cirugia = Typesurgery::with('classification')->find($itinerary->typesurgery_id);
        // dd($cirugia);

        $itinerary->typesurgery_id = null;
        $itinerary->save();

        return response()->json([
            'cirugia' => 'Cirugia eliminada correctamente',202,$cirugia,
        ]);

    }


    //===================eliminar cirugias previas ==========================
    public function cirugia_borrar(Request $request){

        $reservation = Reservation::find($request->reservacion_id);

        $patient = Patient::where('person_id',$reservation->patient_id)->first();

        $patient->previous_surgery= null;
        $patient->save();

        return response()->json([
            'cirugias' => 'Cirugias previas eliminada correctamente',202
        ]);

    }

}

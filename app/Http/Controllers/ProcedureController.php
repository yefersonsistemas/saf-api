<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Procedure;
use App\Diagnostic;
use App\Itinerary;
use App\Employe;
use App\Speciality;

//use Carbon\Carbon;


class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Employe $doctor)
    {   
        // $procedures = $doctor->procedures;
        // $doctors   = Employe::role('doctor')->get();

        $speciality = Speciality::get();
        return view('dashboard.director.procedure',compact('speciality'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $doctor = Employe::find($request->doctor);

        $data =  $request->validate([
            'name'   => 'required',
            'description' => 'required',
            'price'   => 'required',
            'speciality_id' => 'required',
            'price.required' => 'Es obligatorio precio del procedimiento.',
        ]);

        $procedure =  Procedure::create([
            'name'            => $data['name'],
            'description'     => $data['description'],
            'price'           => $data['price'],
            'speciality_id'   => $request->speciality_id,
            'branch_id'       => 1
        ]);

        // $doctor->procedures()->attach($procedure->id);
        
        // return response()->json([
        //     'message' => 'Procedimiento creado satisfactoriamente',
        // ]);

        return redirect()->back()->withSuccess('Registro agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Procedure $procedure)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedure $procedure, $id)
    {
        $procedure = Procedure::with('speciality')->where('id', $id)->first();
        $speciality = Speciality::all();
        $diff = $speciality->diff($procedure->speciality);

        return view('dashboard.director.procedure-edit', compact('procedure', 'diff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $procedure = Procedure::with('speciality')->where('id', $request->id)->first();
        $procedure->name          =  $request->name;
        $procedure->price         =  $request->price;
        $procedure->description   =  $request->description; 
        $procedure->save();   
        
        $procedure->speciality()->sync($request->speciality);
        return redirect()->route('all.register')->withSuccess('Registro modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $procedure = Procedure::find($id);
        $procedure->delete();
        return redirect()->route('all.register')->withSuccess('Procedimiento eliminado');
    }



    //============= Procedimientos realizados en el consultorio =============
    public function procedures_realizados(Request $request){
        // dd($request);
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

        if($itinerary->procedureR_id != null){
            $b_procedure =  explode(',', $itinerary->procedureR_id);
            $diff= array_diff($returndata2,$b_procedure);

            if($diff != null){
                $string = implode(',', $diff);
                $todo = $itinerary->procedureR_id .','. $string;
            }else{
                $string = null;
                // dd($string);
                $todo = $itinerary->procedureR_id;
            }

        }else{
            $string = $data;
            $todo = $data;
        }
        $itinerary->procedureR_id = $todo;
        $itinerary->save();

        $procedures = explode(',', $string); // decodificando los prcocedimientos json

        for ($i=0; $i < count($procedures) ; $i++) {
            $procedure[] = Procedure::find($procedures[$i]);
        }

        return response()->json([
            'procedures' => 'Procedimientos guardados exitosamente',201,$procedure
            ]);
    }


     //================= actualizar procedimientos realizados ==============
     public function proceduresR_update(Request $request){
        // dd($request);
            $itinerary = Itinerary::where('reservation_id', $request->id)->first();

            //buscando procedimientos
            $diagnostic = Diagnostic::with('procedures')->where('id',$request->diagnostic_id)->first();

            // dd($diagnostic);
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

                // codificando arreglo de examenes seleccionados
                    $data =  implode(',', $returndata2);

                    if(!empty($itinerary->procedureR_id)){

                        // buscando solo el id de los examenes guardados
                            for($i=0; $i < count($diagnostic->procedures); $i++){
                                $aux2[$i] = $diagnostic->procedures[$i]->id;
                            }

                        //uniendo erreglos de examenes seleccionados y los guardados
                            $merge_procedure= array_merge($returndata2,$aux2);

                        //guardando examens en la tabla diagnostic_exam
                            foreach($merge_procedure as $item){
                                $b_procedure = Procedure::find($item);
                                $b_procedure->diagnostic()->sync($diagnostic);
                            }

                        //buscar todos los examenes guardados
                            $b_diagnostic = Diagnostic::with('procedures')->where('id',$diagnostic->id)->first();

                        // colocando solo el id en un arreglo
                            for($i=0; $i < count($b_diagnostic->procedures); $i++){
                                $todo[$i] = $b_diagnostic->procedures[$i]->id;
                            }

                        //codificando arreglo
                            $date = implode(',',$todo);

                        //actualizando campo de examenes en itinerary
                            $itinerary->procedureR_id = $date;
                            $itinerary->save(); //actualizando examenes

                        //diferencias entre arrelogs para mostar al usuario
                            $diff_E = array_diff($returndata2,$aux2);

                        //buscando datos de examenes para mostrar
                            if(!empty($diff_E)){
                                foreach($diff_E as $item){
                                    $procedure[] = Procedure::find($item);
                                }
                            }else{
                                $procedure[]=null;
                            }

                    }else{
                         //guardando examens en la tabla diagnostic_exam
                            foreach($returndata2 as $item){
                                $b_procedure = Procedure::find($item);
                                $procedure[] = $b_procedure;
                                $b_procedure->diagnostic()->sync($diagnostic);
                            }

                        //actualizando campo de examenes en itinerary
                            $itinerary->procedureR_id = $data;
                            $itinerary->save(); //actualizando examenes
                    }

                    // dd($procedure);
                return response()->json([
                    'procedures' => 'Procedimientos guardados exitosamente',201,$procedure
                    ]);
            }else{
                return response()->json([
                    'procedures' => 'Seleccione un procedimiento',202
                    ]);
            }
        }


    //================eliminar examen ===================
    public function procedureR_eliminar2(Request $request){

        //buscando en itinerary para actualizar campo
        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();
        $procedures = explode(',', $itinerary->procedureR_id);

        $procedure = null;
        for($i=0; $i < count($procedures); $i++) {
            if($request->id != $procedures[$i]){
                $procedure[] = $procedures[$i];
            }
        }
        // dd($procedure);
        $proce = Procedure::find($request->id);
        // dd($proce);

        //actualizando campo de examenes
        if($procedure != null){
            $itinerary->procedureR_id = implode(',', $procedure);
            $itinerary->save();
        }else{
            $itinerary->procedureR_id = null;
            $itinerary->save();
        }
        return response()->json([
            'procedure' => 'Procedimiento eliminado correctamente',202,$proce,
        ]);

    }

    //================eliminar examen desde el actualizar===================
    public function procedureR_eliminar(Request $request){

        $diagnostic = Diagnostic::find($request->diagnostic_id);
        $procedure = Procedure::find($request->id);

        //borrando examen de la tabla pivote diagnostic_exam
        $diagnostic->procedures()->detach($procedure);

        //buscando en itinerary para actualizar campo
        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();
        $procedures = explode(',', $itinerary->procedureR_id);

        $proce = null;
        for($i=0; $i < count($procedures); $i++) {
            if($request->id != $procedures[$i]){
                $proce[] = $procedures[$i];
            }
        }

        //actualizando campo de examenes
        if($proce != null){
            $itinerary->procedureR_id = implode(',', $proce);
            $itinerary->save();
        }else{
            $itinerary->procedureR_id = null;
            $itinerary->save();
        }

        // dd($procedure);
        return response()->json([
            'procedure' => 'Procedure eliminado correctamente',202,$procedure,
        ]);

    }


      // ================ posibles procedimientos =================
      public function proceduresP(Request $request){
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

        if($itinerary->procedure_id != null){
            $b_procedure =  explode(',', $itinerary->procedure_id);
            $diff= array_diff($returndata2,$b_procedure);

            if($diff != null){
                $string = implode(',',$diff);
                $todo = $itinerary->procedure_id .','. $string;
            }else{
                $string = null;
                $todo = $itinerary->procedure_id;
            }

        }else{
            $string = $data;
            $todo = $data;
        }
        $itinerary->procedure_id = $todo;
        $itinerary->save();

        $procedures = explode(',', $string); // decodificando los prcocedimientos json

        for ($i=0; $i < count($procedures) ; $i++) {
            $procedure[] = Procedure::find($procedures[$i]);
        }

        return response()->json([
            'proceduresR' => 'Procedimientos guardados exitosamente',201, $procedure
        ]);
    }


    // ================ posibles procedimientos =================
    public function procedures_update(Request $request){
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

            $data =  implode(',', $returndata2);

            if(!empty($itinerary->procedure_id)){

                // decodificando los prcocedimientos json
                    $procedures = explode(',', $itinerary->procedure_id);

                //diferencias entre arrelogs para mostar al usuario
                    $diff_P = array_diff($returndata2,$procedures);

                //convirtiendo en string
                    if(!empty($diff_P)){
                        $convertir = implode(',', $diff_P);
                        $itinerary->procedure_id =  $itinerary->procedure_id.','.$convertir;
                    }else{
                        $itinerary->procedure_id =  $itinerary->procedure_id;
                    }

                //actualizando posibles en procedimientos en itinerary
                    $itinerary->save();

                //buscando datos de examenes para mostrar
                    if(!empty($diff_P)){
                        foreach($diff_P as $item){
                            $procedure[] = Procedure::find($item);
                        }
                    }else{
                        $procedure[]=null;
                    }
            }else{
                 //guardando examens en la tabla diagnostic_exam
                    foreach($returndata2 as $item){
                        $b_procedure = Procedure::find($item);
                        $procedure[] = $b_procedure;
                    }

                //actualizando campo de examenes en itinerary
                    $itinerary->procedure_id = $data;
                    $itinerary->save(); //actualizando examenes
            }


            return response()->json([
                'proceduresR' => 'Procedimientos guardados exitosamente',201, $procedure
            ]);
        }else{
            return response()->json([
                'proceduresR' => 'Seleccione un procedimiento',202
            ]);
        }
    }

    
    //================ eliminar posibles procedimientos ===================
    public function procedureP_eliminar2(Request $request){

        //buscando en itinerary para actualizar campo
        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();
        $procedures = explode(',', $itinerary->procedure_id);

        $procedure = null;
        for($i=0; $i < count($procedures); $i++) {
            if($request->id != $procedures[$i]){
                $procedure[] = $procedures[$i];
            }
        }

        $proce = Procedure::find($request->id);
        //actualizando campo de examenes
        if($procedure != null){
            $itinerary->procedure_id = implode(',', $procedure);
            $itinerary->save();
        }else{
            $itinerary->procedure_id = null;
            $itinerary->save();
        }

        return response()->json([
            'procedure' => 'Examen eliminado correctamente',202,$proce,
        ]);

    }

}


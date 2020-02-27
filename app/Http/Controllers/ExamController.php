<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Patient;
use App\Itinerary;
use App\Diagnostic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
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
        return view('dashboard.director.exam');
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

        $exam = Exam::create([
            'name'  => $data['name'],
            'branch_id' => 1,
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
        $exam = Exam::find($id);

        return view('dashboard.director.exam-edit', compact('exam'));
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
        $exam = Exam::find($request->id);

        $exam->name = $request->name;
        $exam->update();

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
        $exam = Exam::find($id);
        $exam->delete();
        return redirect()->route('all.register')->withSuccess('Exámen eliminado');
    }

    public function exams(Request $request)
    {
        $patient = Patient::with('diagnostic.exam')->where('person_id', $request->person_id)->first();

        // $exam = Exam::get();
        // //dd($patient);
        // $pdf = PDF::loadView('pdf.exam', compact('exam')); //vista generada por el componente PDF
        //             //carpeta.namearchivo
        return response()->json([
            // 'Exams' => $pdf->download('exam.pdf'), 
            'exams' => $patient,
        ]);
    }

      //======================= Examenes a realizar(paciente) ==================
      public function examR(Request $request){
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

        if($itinerary->exam_id != null){
            $b_exam =  explode(',', $itinerary->exam_id);
            $diff= array_diff($returndata2,$b_exam);

            // dd($diff);
            if($diff != null){
                $string = implode(',',$diff);
                $todo = $itinerary->exam_id .','. $string;
            }else{
                $string = null;
                $todo = $itinerary->exam_id;
            }


        }else{
            $string = $data;
            $todo = $data;
        }

        $itinerary->exam_id = $todo;
        $itinerary->save();

        $examenes = explode(',', $string); // decodificando los prcocedimientos json

        for ($i=0; $i < count($examenes) ; $i++) {
            $examen[] = Exam::find($examenes[$i]);
        }

        // dd($examen);
        return response()->json([
            'exam' => 'Examenes guardados exitosamente',201,$examen
        ]);
    }

    //============== actualizar Examenes a realizar al paciente ============
    public function exam_update(Request $request){

        $itinerary = Itinerary::where('reservation_id', $request->id)->first();
        $diagnostic = Diagnostic::with('exam')->where('id',$request->diagnostic_id)->first();

        $returndata2 = array();
        if(!empty($request->data)){
            $strArray = explode('&', $request->data);

            foreach($strArray as $item) {
                $array = explode("=", $item);
                $returndata[] = $array;
            }

            for($i=0; $i < count($returndata); $i++){
                for($y=1; $y <= 1; $y++){
                $returndata2[$i] = $returndata[$i][$y]; // colocando los datos en un arreglo
                }
            }

            // codificando arreglo de examenes seleccionados
                $data =  implode(',', $returndata2);

            //para asegurarse de que no se repitan los examenes
                if(!empty($itinerary->exam_id)){

                    // buscando solo el id de los examenes guardados
                        for($i=0; $i < count($diagnostic->exam); $i++){
                            $aux2[$i] = $diagnostic->exam[$i]->id;
                        }

                    //uniendo erreglos de examenes seleccionados y los guardados
                        $merge_exam= array_merge($returndata2,$aux2);

                    //guardando examens en la tabla diagnostic_exam
                        foreach($merge_exam as $item){
                            $b_exam = Exam::find($item);
                            $b_exam->diagnostic()->sync($diagnostic);
                        }

                    //buscar todos los examenes guardados
                        $b_diagnostic = Diagnostic::with('exam')->where('id',$diagnostic->id)->first();

                    // colocando solo el id en un arreglo
                        for($i=0; $i < count($b_diagnostic->exam); $i++){
                            $todo[$i] = $b_diagnostic->exam[$i]->id;
                        }

                    //codificando arreglo
                        $date = implode(',',$todo);

                    //actualizando campo de examenes en itinerary
                        $itinerary->exam_id = $date;
                        $itinerary->save(); //actualizando examenes

                    //diferencias entre arrelogs para mostar al usuario
                        $diff_E = array_diff($returndata2,$aux2);

                    //buscando datos de examenes para mostrar
                        if(!empty($diff_E)){
                            foreach($diff_E as $item){
                                $examen[] = Exam::find($item);
                            }
                        }else{
                            $examen[]=null;
                        }

                }else{
                     //guardando examens en la tabla diagnostic_exam
                        foreach($returndata2 as $item){
                            $b_exam = Exam::find($item);
                            $examen[] = $b_exam;
                            $b_exam->diagnostic()->sync($diagnostic);
                        }

                    //actualizando campo de examenes en itinerary
                        $itinerary->exam_id = $data;
                        $itinerary->save(); //actualizando examenes
                }

            return response()->json([
                'exam' => 'Examenes guardados exitosamente',201,$examen
            ]);
        }else{
            return response()->json([
                'exam' => 'Seleccione un examen',202
            ]);
        }
    }

    //================eliminar examen ===================
    public function exam_eliminar2(Request $request){

        //buscando en itinerary para actualizar campo
        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();
        $examenes = explode(',', $itinerary->exam_id);

        $exam = null;
        for($i=0; $i < count($examenes); $i++) {
            if($request->id != $examenes[$i]){
                $exam[] = $examenes[$i];
            }
        }
        $examen = Exam::find($request->id);
        //actualizando campo de examenes
        if($exam != null){
            $itinerary->exam_id = implode(',', $exam);
            $itinerary->save();
        }else{
            $itinerary->exam_id = null;
            $itinerary->save();
        }

        return response()->json([
            'exam' => 'Examen eliminado correctamente',202,$examen,
        ]);

    }

    
    //================eliminar examen desde el actualizar===================
    public function exam_eliminar(Request $request){

        $diagnostic = Diagnostic::find($request->diagnostic_id);
        $exams = Exam::find($request->id);

        //borrando examen de la tabla pivote diagnostic_exam
        $diagnostic->exam()->detach($exams);

        //buscando en itinerary para actualizar campo
        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();
        $examenes = explode(',', $itinerary->exam_id);

        $exam = null;
        for($i=0; $i < count($examenes); $i++) {
            if($request->id != $examenes[$i]){
                $exam[] = $examenes[$i];
            }
        }

        //actualizando campo de examenes
        if($exam != null){
            $itinerary->exam_id = implode(',', $exam);
            $itinerary->save();
        }else{
            $itinerary->exam_id = null;
            $itinerary->save();
        }

        return response()->json([
            'exam' => 'Examen eliminado correctamente',202,$exams,
        ]);

    }

}

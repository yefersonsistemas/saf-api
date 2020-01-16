<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\redirect;
use Illuminate\Http\Request;
use App\Patient;
use App\Medicine;
use App\Exam;
use App\Diagnostic;
use App\Procedure;
use App\Surgery;
use App\Typesurgery;
use Carbon\Carbon;
use App\Http\Requests\CreateDiagnosticRequest;
use App\Employe;
use App\Billing;
use App\Reservation;
use App\Person;
use Illuminate\Support\Facades\Auth;
use App\Doctor;
use App\Itinerary;
use App\Reference;
use App\Speciality;
use App\Treatment;
use App\Recipe;
use App\Repose;
use App\ReportMedico;
use App\InputOutput;
// use App\Redirect;

use RealRashid\SweetAlert\Facades\Alert;
use App\Disease;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id= Auth::id();
        $empleado = Employe::where('id', $id)->first();
        $today = Reservation::with('patient.historyPatient','patient.inputoutput')->where('person_id',$empleado->person_id )->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();
      
        $all = Reservation::with('patient.historyPatient')->where('person_id',$id)->get();
        $month = Reservation::with('patient.historyPatient')->where('person_id',$id )->whereMonth('date', '=', Carbon::now()->month)->get();

        $date = Carbon::now();
        $week = Reservation::with('patient.historyPatient')->where('person_id',$id)->whereBetween('date', [$date->startOfWeek()->format('Y-m-d'), $date->endOfWeek()->format('Y-m-d')])->get();
        
        $fecha= Carbon::now()->format('Y/m/d h:m:s'); //la h en minuscula muestra hora normal, y en mayuscula hora militar

        return view('dashboard.doctor.index', compact('today','month', 'all', 'week', 'fecha'));
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

     //============= doctor por reservacion con su diagnostico y razon de la cita ============
    public function show($id)
    {
        $medicines = Medicine::all();
        $specialities = Speciality::all(); 
        $history = Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')->where('patient_id',$id)
        ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();
        
        $procesm = Employe::with('procedures')->where('id', $history->person_id)->first(); 
     
        $cite = Patient::with('person.reservationPatient.speciality', 'reservation.diagnostic.treatment')
            ->where('person_id', $id)->first();

        $exams = Exam::all();

        $surgerys = Typesurgery::all();

        return view('dashboard.doctor.historiaPaciente', compact('history','cite', 'exams','medicines','specialities', 'surgerys', 'procesm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // ======================== actualizacion de historia ======================
    public function edit($id)
    {
        $reservation = Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')
        ->where('id',$id)->first();
     
        $cite = Patient::with('person.reservationPatient.speciality', 'reservation.diagnostic.treatment')
        ->where('person_id', $reservation->patient_id)->first();
     
        $b_patient = Patient::where('person_id', $reservation->patient_id)->first();
        
        $r_patient = Diagnostic::with('repose', 'reportMedico','exam','procedures')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('patient_id', $b_patient->id)->where('employe_id', $reservation->person_id)->first();

        // dd($r_patient->procedures);
        $itinerary = Itinerary::with('recipe.medicine.treatment', 'typesurgery','reference.speciality','reference.employe.person')->where('patient_id', $reservation->patient_id)->first();
   
        $speciality = Speciality::all(); 
        $medicines = Medicine::all();

         //decodificando y buscando datos de procedures realizados
            if (!empty($itinerary->procedure_id)) {
                $proceduresP_id = explode(',', $itinerary->procedure_id); //decodificando los procedimientos en $encontrado
                if (!empty($proceduresP_id)) {
                    foreach($proceduresP_id as $procedure){
                        $procedures[] = Procedure::find($procedure);
                    }
                }
            }else{
                $procedures = null;
            }
            
        //decodificando y buscando datos de examenes
            if (!empty($itinerary->exam_id)) {
                $exam_id = explode(',', $itinerary->exam_id); //decodificando los procedimientos en $encontrado
                if (!empty($exam_id)) {
                    foreach($exam_id as $exam){
                        $exams[] = Exam::find($exam);
                    }
                }
            }else{
                $exams = null;
            }

            $procesm = Employe::with('procedures')->where('id', $reservation->person_id)->first(); 
            $examenes = Exam::all();
            $cirugias = TypeSurgery::get();

        // buscando diferencia de procedimientos realizados
            if (!empty($itinerary->procedureR_id)) {
                $diff_PR = $procesm->procedures->diff($r_patient->procedures);    
            }else{
                $diff_PR = $procesm->procedures;
            }
    
        // buscando diferencia de examenes 
            if ($itinerary->exam_id != null) {
                $diff_E = $examenes->diff($exams);
            }else{
                $diff_E = $examenes;
            }
      
        // busacndo posibles procedimientos 
            if (!empty($itinerary->procedure_id)) {
                $diff_P = $procesm->procedures->diff($procedures);
            }else{
                $diff_P = $procesm->procedures;
            }
            
        // buscando posibles cirugias
            $surgery = array($itinerary->typesurgery);
            if(!empty($itinerary->typesurgery)){
                $diff_C = $cirugias->diff($surgery);
            }else{
                $diff_C = $cirugias;
            }   

        return view('dashboard.doctor.editar', compact('speciality','r_patient','procedures', 'exams', 'reservation','cite','procesm','diff_PR', 'diff_E', 'diff_P', 'itinerary','medicines','diff_C','surgery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



     //=============================== actualizar diagnostico =============================
    public function update(Request $request, $id)
    {
        //buscar reservacion
            $reservation = Reservation::where('id',$id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->first();

        //buscando reservacion en itinerary
            $itinerary = Itinerary::find($reservation->id);

        //buscando el id del paciente para buscar diagnostico
            $b_patient = Patient::where('person_id', $reservation->patient_id)->first();

        //buscando diagnostico 
            $diagnostic = Diagnostic::whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->where('patient_id', $b_patient->id)->where('employe_id', $reservation->person_id)->first();

       //actualizando campos de diagnostico
            $diagnostic->description = $request->diagnostic;
            $diagnostic->reason = $request->razon;
            $diagnostic->enfermedad_actual = $request->enfermedad;
            $diagnostic->examen_fisico = $request->examen_fisico;
            $diagnostic->indications = $request->indicaciones;
            $diagnostic->save();

       
        //actualizacion de reposo
            if($request->reposo_id != null){
                $reposo = Repose::find($request->reposo_id);
                $reposo->description = $request->reposop;
                $reposo->save();
            }
            
        //crear reposo y actualizar campo en itinerary y diagnostico
            if($request->reposop != null && $request->reposo_id == null){
                $reposo = Repose::create([
                    'patient_id'        =>  $reservation->patient_id,
                    'employe_id'        =>  $reservation->person_id,
                    'description'       =>  $request->reposop, 
                    'branch_id'         =>  1
                ]);
               
                $itinerary->repose_id = $reposo->id;
                $itinerary->save();
                $diagnostic->repose_id = $reposo->id;
                $diagnostic->save();
            }

        //actualizacion de reporte medico
            if($request->report_medico_id != null){
                $reporte = ReportMedico::find($request->report_medico_id);
                $reporte->descripction = $request->reporte;
                $reporte->save();
            }
        
        //crear reporte medico y actualizar campo en itinerary y diagnostico
            if($request->reporte != null && $request->report_medico_id == null){
                $reporte = ReportMedico::create([
                    'patient_id'        =>  $b_patient->id,
                    'employe_id'        =>  $reservation->person_id,
                    'descripction'      =>  $request->reporte,
                    'branch_id'         =>  1
                ]);
             
                $itinerary->report_medico_id = $reporte->id;
                $itinerary->save();
                $diagnostic->report_medico_id = $reporte->id;
                $diagnostic->save();
            }

            return redirect()->route('doctor.index')->withSuccess('Historia actualizada');
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
    
    // Para visualizar el Pago total del doctor
    public function recordpago() {
        $id=Auth::id();
        $employe = Employe::with('person.user', 'doctor.typedoctor', 'patient')->where('person_id', $id)->first();
        // dd($employe);
        if ($employe->position->name != 'doctor' || !$employe->person->user->role('doctor')) {
            return response()->json([
                'message' => 'empleado no es medico',
            ]);
        }
        
        $inicio = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $fin = Carbon::now()->endOfWeek(Carbon::FRIDAY);
        
        $billing = Billing::with('procedures', 'patient')->where('employe_id', $employe->id)->whereBetween('created_at', [$inicio , $fin])->get();
        // dd($billing);
        $total = 0;
        foreach($billing as $b){
            foreach ($b->procedures as $procedure) {
                $total += $procedure->price;
            }
        }

        $pago = ((($employe->doctor->typedoctor->comission * $employe->doctor->price) * count($billing)) + $total);
        // dd($id);

        return view('dashboard.doctor.recordpago', compact('pago'));
    }

    // ================= Redireccion a formulario para crear diagnostico ============== 
    public function crearDiagnostico($id){
        $patient = Person::find($id);
        $exams = Exam::all();
        return view('dashboard.doctor.crearDiagnostico', compact('patient', 'exams'));
    }

    // ================= Redireccion a formulario para crear recipe ============== 
    public function crearRecipe($paciente, $employe){
        $medicines = Medicine::all();
        return view('dashboard.doctor.crearRecipe', compact('medicines','paciente', 'employe'));
    }

    // ================= Redireccion a formulario para crear referencia ============== 
    public function crearReferencia(Person $patient){
        $specialities = Speciality::all();
        return view('dashboard.doctor.crearReferencia', compact('patient','specialities'));
    }


    // ================================= referir doctor ======================================
    public function referenceStore(Request $request)
    {
        $person = Person::with('historyPatient')->where('id',$request->patient)->first();
        $io = InputOutput::where('person_id', $person->id)->first();
        
        if (!empty($io->inside) && !empty($io->inside_office) && empty($io->outside_office) && empty($io->outside) ) {

            if($request->doctor != null  || $request->doctorExterno != null){

                if($request->speciality != null && $request->reason != null){

                    $reference = Reference::create([
                        'patient_id'    =>  $person->id,
                        'specialitie_id'    =>  $request['speciality'],
                        'reason'        =>  $request['reason'],
                        'employe_id'    =>  $request->doctor,
                        'doctor'        =>  $request->doctorExterno,
                    ]);

                    $itinerary = Itinerary::where('patient_id', $person->id)->first();
                    if (!is_null($itinerary)) {
                        $itinerary->reference_id = $reference->id;
                        $itinerary->save();
                    }

                    return response()->json([
                        'reference' => 'Médico referido',201
                    ]);
                }else{
                    return response()->json([
                        'reference' => 'Datos incompletos',202
                    ]);
                }
            }{
                return response()->json([
                    'reference' => 'Datos incompletos',202
                ]);
            }
         }else{
            return response()->json([
                'reference' => 'No se pudo generar su referencia',202
            ]);
         }
    }


    // ================================= crear recipe y guardar medicinas con tratamientos ======================================
    public function recipeStore(Request $request)
    {
        $itinerary = Itinerary::with('person','employe.person','reservation')->where('reservation_id', $request->reservacion)->first();

        if(!empty($itinerary)){
            if($itinerary->recipe_id == null){
                
                // crear el recipe
                $crear_recipe = Recipe::create([               
                    'patient_id'   =>  $itinerary->patient_id,
                    'employe_id'   =>  $itinerary->employe_id,
                    'branch_id'    =>  1,
                ]);

                //actualiza el campo de recipe en itinerary
                $itinerary->recipe_id = $crear_recipe->id;     
                $itinerary->save();

            }else{
                $crear_recipe = Recipe::where('id', $itinerary->recipe_id)->first();
            }

            // $paciente = Person::find($paciente);
            $treatment = Treatment::create([
                'medicine_id'   =>  $request->medicina,
                'doses'         =>  $request->dosis,
                'duration'      =>  $request->duracion,
                'measure'       =>  $request->medida,
                'indications'   =>  $request->indicaciones,
                'recipe_id'     =>  $crear_recipe->id,
                'branch_id'     =>  1,
            ]);

            $crear_recipe->medicine()->attach($request->medicina);

            $treatments = Treatment::with('medicine')->where('id', $treatment->id)->first();

            return response()->json($treatments);
        }else{
            return response()->json([
                'recipe' => 'No se pudo generar recipe', 202,
            ]);
        }
    }


    // ================================= Guardar diagnostico ======================================
    public function storeDiagnostic(Request $request)
    {
        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();
        $reservation = Reservation::where('id', $request->reservacion_id)->first();
        $patient = Patient::where('person_id', $reservation->patient_id)->first();

        if($itinerary != null){
                $io = InputOutput::where('person_id', $itinerary->patient_id)->where('employe_id', $itinerary->employe_id)->first();
        
            if (empty($io->outside_office) && (!empty($io->inside_office))) {
                $io->outside_office = 'fuera';
                $io->save();
                $itinerary->status = 'fuera_office';
                $itinerary->save();

                if($itinerary != null){

                    if($request->reposop != null){
                    //-------- crear reposo ---------
                    $reposo = Repose::create([
                        'patient_id'        =>  $request->patient_id,
                        'employe_id'        =>  $request->employe_id,
                        'description'       =>  $request->reposop, 
                        'branch_id'         =>  1
                    ]);

                    $reposo_id = $reposo->id;
                    $itinerary->repose_id = $reposo_id;
                    $itinerary->status = 'fuera_office';
                    $itinerary->save();

                    }else{
                        $reposo_id = null;
                    }

                    if($request->reporte != null){
                    //------- crear informe medico -------
                    $reporte = ReportMedico::create([
                        'patient_id'        =>  $patient->id,
                        'employe_id'        =>  $request->employe_id,
                        'descripction'      =>  $request->reporte,
                        'branch_id'         =>  1
                    ]);

                    $reporte_id = $reporte->id;
                    $itinerary->report_medico_id = $reporte_id;
                    $itinerary->save();
                    }else{
                        $reporte_id = null;
                    }

                    // ------ guardando diagnostico ------
                    $diagnostic = Diagnostic::create([
                        'patient_id'        =>  $patient->id, //esta
                        'description'       =>  $request->diagnostic,  //esta
                        'reason'            =>  $request->razon, //esta
                        'enfermedad_actual' =>  $request->enfermedad_actual, //esta
                        'examen_fisico'     =>  $request->examen_fisico,//esta
                        'report_medico_id'  =>  $reporte_id, //esta
                        'repose_id'         =>  $reposo_id,  //esta
                        'indications'       =>  $request->indicaciones, //esta
                        'employe_id'        =>  $reservation->person_id, //esta
                        'branch_id'         =>  1,
                    ]);


                    //--------------Guardando examenes------------
                    if(!empty($itinerary->exam_id)){
                        $examen  =  explode(',', $itinerary->exam_id);
                        for ($i=0; $i < count($examen) ; $i++) { 
                            $exam = Exam::find($examen[$i]);
                            $exam->diagnostic()->sync($diagnostic);
                        }
                    }

                    //--------------Guardando procedimientos realizados------------
                    if(!empty($itinerary->procedureR_id)){
                        $procedure  =  explode(',', $itinerary->procedureR_id);
                        for ($i=0; $i < count($procedure) ; $i++) { 
                            $proce = Procedure::find($procedure[$i]);
                            $proce->diagnostic()->sync($diagnostic);
                        }
                    }
                    
                                    
                    Alert::success('Diagnostico creado exitosamente!');
                    return redirect()->route('doctor.index');

                }else{
                    Alert::error('No se pudo generar su diagnostico!');
                    return redirect()->back();
                }
            }else{
                Alert::error('No se pudo generar su diagnostico!');
                return redirect()->back();
            }
        }else{
            Alert::error('No se pudo generar su diagnostico!');
            return redirect()->back();
        }
    }
    //============================== buscar doctor =====================
    public function searchDoctor(Request $request)
    {
        $doctors = Speciality::with('employe.person', 'employe.image')->where('id', $request->id)->get();

        if (!is_null($doctors->first()->employe)) {
            return $doctors;
        }else{
            return response()->json([
                202,
                'message' => 'sin medicos',
            ]);
        }
    }

    /**
     * 
     * Busca el horario del doctor y 
     * retorna los dias que el no tenga disponible
     * 
     */

     //======================== buscando horario ====================
    public function search_schedule(Request $request){//busca el horario del medico para agendar cita
        // dd($request->id);
        $employe = Employe::with('schedule')->where('id', $request->id)->first();
        $available = collect([]);
        // dd($available);
        if (!is_null($employe)) {
            if (!is_null($employe->schedule)) {
                foreach ($employe->schedule as $schedule) {
                    $date[]  = new Carbon('next ' . $schedule->day);
                    $quota[] = $schedule->quota;
                }

                for ($i = 0; $i < count($date); $i++) {
                    /**
                     * El 12 del ciclo for j,
                     * hace referencia a 12 semanas que es la mayor 
                     * anticipacion a la q se puede tener una cita
                     */
                    for ($j= 0; $j < 12; $j++) { 
                        $citesToday = Reservation::whereDate('date', $date[$i])->where('approved', '!=', null)->get()->count();
                        if ($citesToday < $quota[$i]) {
                            $available->push((Carbon::create($date[$i]->year, $date[$i]->month, $date[$i]->day)));
                            $prueba [] = array((Carbon::create($date[$i]->year, $date[$i]->month, $date[$i]->day)));
                        }
                        $date[$i] = $date[$i]->addWeek();
                    }
                }

                $total = $available->first()->diffInDays($available->last());
                // dd($total);
                $not = collect([]);
                $min = Carbon::create($available->min()->year, $available->min()->month, $available->min()->day)->addDay();
                
                for ($i=0; $i <$total ; $i++) { 
                    $not->push(Carbon::create($min->year, $min->month, $min->day));
                    $min->addDay();
                }

                $diff = $not->diff($available);

                $diff = $diff->map(function($d)
                {
                    return $d->format('m/d/Y'); 
                });

                foreach ($diff as $d) {
                    $dates[] = $d;
                }

                return response()->json([
                    'employe'       => $employe,
                    'available'     => $available,
                    'start'         => $available->min()->format('m/d/Y'),
                    'end'           => $available->max()->format('m/d/Y'),
                    'diff'          => $dates,
                    'prueba'        => $prueba,
                ]);

            }else{
                return response()->json([
                    'message' => 'Medico sin horario',
                ]);
            }
        }else{
            return response()->json([
                'message' => 'Medico no encontrado',
            ]);
        }
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

        $itinerary->procedureR_id = $data;
        $itinerary->save();

        $procedures = explode(',', $itinerary->procedureR_id); // decodificando los prcocedimientos json
        
        for ($i=0; $i < count($procedures) ; $i++) { 
            $procedure[] = Procedure::find($procedures[$i]);
        }

        return response()->json([
            'procedures' => 'Procedimientos guardados exitosamente',201,$procedure
            ]);
        }

        //================= actualizar procedimientos realizados ==============
        public function proceduresR_update(Request $request){
            // dd($request->data);
            $itinerary = Itinerary::where('reservation_id', $request->id)->first();

            //buscando procedimientos
            $diagnostic = Diagnostic::with('procedures')->where('id',$request->diagnostic_id)->first();
            // dd($diagnostic->procedures);
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
                                $b_procedure = Exam::find($item);
                                $b_procedure->diagnostic()->sync($diagnostic);
                            } 
    
                        //buscar todos los examenes guardados
                            $b_diagnostic = Diagnostic::with('procedures')->where('id',$request->diagnostic_id)->first();
    
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
        
                return response()->json([
                    'procedures' => 'Procedimientos guardados exitosamente',201,$procedure
                    ]);
            }else{
                return response()->json([
                    'procedures' => 'Seleccione un procedimiento',202
                    ]);
            }
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

        if($itinerary->exam_id == null){
            $itinerary->exam_id = $data;
            $itinerary->save();

            $examenes = explode(',', $itinerary->exam_id); // decodificando los prcocedimientos json
            for ($i=0; $i < count($examenes) ; $i++) { 
                $examen[] = Exam::find($examenes[$i]);
            }
        }else{
            $examenes = explode(',', $itinerary->exam_id); // decodificando los prcocedimientos json
         
            $diff_E = array_diff($returndata2,$examenes);
       
            if(!empty($diff_E)){
                $examenes = implode(',', $diff_E);
                $convertir = $itinerary->exam_id.','.$examenes ;
                for ($i=0; $i < count($diff_E) ; $i++) { 
                    $examen[] = Exam::find($diff_E[$i]);
                }
            }else{
                $convertir = $itinerary->exam_id;
                $examen[]=null;
            }

            $itinerary->exam_id = $convertir;
            $itinerary->save();

        }   

       
        return response()->json([
            'exam' => 'Examenes guardados exitosamente',201,$examen
        ]);
    }

    //============== actualizar Examenes a realizar al paciente ============
    public function exam_update(Request $request){
    // dd($request);

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
                        $b_diagnostic = Diagnostic::with('exam')->where('id',$request->diagnostic_id)->first();

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
            'exam' => 'Examen eliminado correctamente',202
        ]);

    }

    // ================ posibles procedimientos =================
    public function proceduresP(Request $request){
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

        $itinerary->procedure_id = $data;
        $itinerary->save();

        $procedures = explode(',', $itinerary->procedure_id); // decodificando los prcocedimientos json
        // dd($procedures);

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
            $date = $itinerary->procedure_id . ',' . $data;
            $itinerary->procedure_id = $date;
            }else{
                $itinerary->procedure_id = $data;
            }

            $itinerary->save();

            $procedures = explode(',', $data); // decodificando los prcocedimientos json
            // dd($procedures);

                for ($i=0; $i < count($procedures) ; $i++) { 
                    $procedure[] = Procedure::find($procedures[$i]);
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

    //Candidato a cirugias
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

        $itinerary->typesurgery_id = $data;
        $itinerary->save();

        $surgerys = explode(',', $itinerary->typesurgery_id); // decodificando los prcocedimientos json
        
        for ($i=0; $i < count($surgerys) ; $i++) { 
                    $surgery[] = TypeSurgery::find($surgerys[$i]);
                }

        return response()->json([
            'surgerysR' => 'Cirugias guardadas exitosamente',201,$surgery
        ]);
    }

     //Candidato a cirugias
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
            $data =  implode(',', $returndata2);
            
            if(!empty($itinerary->typesurgery_id)){
            $date = $itinerary->typesurgery_id .','. $data;
            $itinerary->typesurgery_id = $date;
            }else{
                $itinerary->typesurgery_id = $data;
            }
            $itinerary->save();

            $surgerys = explode(',', $data); // decodificando los prcocedimientos json
            
            for ($i=0; $i < count($surgerys) ; $i++) { 
                        $surgery[] = TypeSurgery::find($surgerys[$i]);
                    }

            return response()->json([
                'surgerysR' => 'Cirugias guardadas exitosamente',201,$surgery
            ]);
        }else{
            return response()->json([
                'surgerysR' => 'Seleccione una cirugia',202
            ]);
        }
    }

}

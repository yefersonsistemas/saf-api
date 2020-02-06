<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Specilaity;
Use App\Employe;
Use App\Area;
Use App\Billing;
Use App\Reference;
Use App\Repose;
Use App\Schedules;
use App\Http\Requests\CreateBillingRequest;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\InController;
use App\Patient;
use App\Person;
use App\TypeCurrency;
use App\TypePayment;
use App\InputOutput;
use App\Exam;
use App\Reservation;
use App\Itinerary;
use App\TypeSurgery;
use App\Surgery;
use App\ClassificationSurgery;
use App\Procedure;
use App\Recipe;
use App\ReportMedico;
use App\Speciality;
use App\Diagnostic;
use App\Treatment;
use Carbon\Carbon;
use App\Http\Requests\CreateVisitorRequest;
// use App\Procedure_billing;
use RealRashid\SweetAlert\Facades\Alert;

use Barryvdh\DomPDF\Facade as PDF; //alias para el componnete de pdf

class OutController extends Controller
{
    //=================== listando los pacientes del dia ================== (listo)
    public function index()
    {
        $procedures_id = array(); 
        $itinerary = Itinerary::with('person.inputoutput', 'employe.person', 'procedure','employe.doctor','typesurgery', 'exam','recipe','reservation','billing')->get(); // esta es una coleccion
        $itineraryFuera = Itinerary::with('person.inputoutput', 'employe.person', 'procedure','employe.doctor','typesurgery', 'exam','recipe','reservation','billing')->get(); // esta es una coleccion
        // dd($itinerary);
        foreach ($itinerary as $iti) {
            if ($iti->procedure_id != null) {
                $procedures_id[] = explode(',', $iti->procedure_id); //decodificando los procedimientos en $encontrado
                if ($procedures_id != null) {
                    for ($i=0; $i < count($procedures_id); $i++) {
                        $procedures = Procedure::find($procedures_id[$i]);
                        $iti->procedures = $procedures;
                    }
                }
            }
        }

        $confirmadas = Reservation::with('person', 'patient.image', 'patient.inputoutput','patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get();
// dd($confirmadas->first()->speciality);
        $espera =  Reservation::with('person', 'patient.image', 'patient.inputoutput','patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get();

        return view('dashboard.checkout.citas-pacientes', compact('itinerary','confirmadas','espera','itineraryFuera'));
    }

    // public function buscador(Request $request)
    // {
    //     $patients = Person::with('patient')->where('dni', $request->patient)->first();

    //     return view('dashboard.checkout.citas-pacientes', compact('patients'));
    // }


    //====================== crear examen ============================ (listo)
    public function crearExamen($patient_id){

        $patient = $patient_id;
        $exams = Exam::all();
        return view('dashboard.checkout.crearDiagnostico', compact('patient','exams'));
    }


     //====================== guardar examen ============================ (listo)
    public function storeDiagnostic(Request $request, $id)
    {
        $itinerary = Itinerary::with('person')->where('patient_id', $id)->first();
        
        $diagnostico = Diagnostic::with('patient.person')->where('id',$itinerary->diagnostic_id)->first();

        $diagnostico->indications = $request->indicaciones;
        $diagnostico->save();

        foreach ($request->multiselect4 as $examen) {
            $diagnostico->exam()->attach($examen);
            $examenes =  implode(',', $request->multiselect4);
        }
       
        $itinerary->exam_id = $examenes;
        $itinerary->save();
        

        //Para mostrar lista de citas de pacientes
        $procedures_id = array();
        $itinerary = Itinerary::with('person.inputoutput', 'employe.person', 'procedure','employe.doctor','typesurgery','exam','recipe','reservation')->get(); // esta es una coleccion
        foreach ($itinerary as $iti) {
            if ($iti->procedure_id != null) {
                $procedures_id[] = explode(',', $iti->procedure_id); //decodificando los procedimientos en $encontrado
                if ($procedures_id != null) {
                    for ($i=0; $i < count($procedures_id); $i++) {
                        $procedures = Procedure::find($procedures_id[$i]);
                        $iti->procedures = $procedures;
                    }
                }
            }
        }
      
        Alert::success('Examen generado');
        return view('dashboard.checkout.citas-pacientes', compact('itinerary'));
    }

    //====================== lista de cirugias ============================ (listo)
    public function index_cirugias()
    {
        $cirugias_ambulatorias = ClassificationSurgery::with('typeSurgeries')->where('name','ambulatoria')->get();
        $cirugias_hospitalarias = ClassificationSurgery::with('typeSurgeries')->where('name','hospitalaria')->get();
        $clasificacion = ClassificationSurgery::all();
        return view('dashboard.checkout.cirugias', compact('cirugias_ambulatorias', 'cirugias_hospitalarias', 'clasificacion'));
    }


     //====================== detalles de las cirugias ============================ (listo)
     public function cirugias_detalles($id, $cirugia)
     {
        //  dd($id);
        $tipo_cirugia = $cirugia;
        $cirugias = TypeSurgery::with('classification','procedure','equipment')->where('id', $id)->first();
        // dd($cirugias);
        return view('dashboard.checkout.cirugias-detalles', compact('cirugias', 'tipo_cirugia'));
     }


    //============================ buscanco paciente ============================ (listo)
    public function search_patient(Request $request){

        if(!empty($request->dni)){ 
        
        $person = Person::where('dni', $request->dni)->first();

        if(!empty($person)){

            $itinerary = Itinerary::where('patient_id', $person->id)->first();
            if(!empty($itinerary)){

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
        }else{
            return response()->json([
                'encontrado' => 'Debe ingresar un valor de busqueda',202
            ]);
        }
    }

 
    //============== buscando procedimiento y mostrando en la vista para generar factura============== (listo)
    public function create(){
        $procedimientos = Procedure::all();
        $fecha = Carbon::now()->format('Y-m-d');
        return view('dashboard.checkout.facturacion', compact('procedimientos','fecha'));
    }

     //============== buscando procedimiento y mostrando en la vista para generar factura============== (listo)
     public function createF($id){
         $itinerary = Itinerary::with('person','employe.person','employe.doctor', 'surgeryR')->where('id', $id)->first();
      
        $procedures = explode(',', $itinerary->procedureR_id); //decodificando los procedimientos en $encontrado

        $procedimientos = Procedure::all();
        $fecha = Carbon::now()->format('Y-m-d');
       
        //-------para el precio de los procedimientos------
        $total_P=0;
        $si=false;
        if(!empty($procedures)){
            for ($i=0; $i < count($procedures) ; $i++) {          //buscando datos de cada procedimiento
                $procedureS[] = Procedure::find($procedures[$i]);
                if($procedureS[$i]->name != 'Consulta médica'){
                    $total_P += $procedureS[$i]->price;
                }else{
                    $si = true;
                }
            }
        }else{
            $procedureS = null;
            $total_P = null;
        }
        
        //----- para el precio de la corigia----
        $total_S=0;
        if(!empty($itinerary->surgeryR)){
            $total_S = $itinerary->surgeryR->cost;
        }else{
            $total_S = null;
        }

        //---------precio de la consulta--------
        $total_C=0;
        if($si == true){
            $total_C = $itinerary->employe->doctor->price;
        }
        
        $total = $total_P + $total_S + $total_C;
      

        return view('dashboard.checkout.facturacionf', compact('procedimientos','fecha','itinerary','procedureS','total'));
    }


    //============================ buscando procedimiento ============================ (listo)
    public function search_procedure($procedure_id){

        $data_procedure = Procedure::where('id', $procedure_id)->first();
    
        if (!is_null($data_procedure)) {
            return response()->json([
                'procedure' => $data_procedure,201
            ]);
        }else{
            return response()->json([
                'message' => 'No encontrado',202
            ]);
        }
    }

    //============================================ guardar factura ======================================== (listo)
    public function guardar_factura(Request $request)
    {
        if($request->patient_id != null && $request->employe_id != null){
            
            $total = $request->total_cancelar; // el $total_cancelar viene de la funcion ajax y se muestra en la siguiente vista
            $tipo_moneda = TypeCurrency::all();
            $tipo_pago = TypePayment::all();

            $itinerary = Itinerary::with('person', 'employe.person', 'procedure','employe.doctor','surgeryR','billing')->where('patient_id', $request->patient_id)->first();
            // dd($itinerary->billing);
            $fecha = Carbon::now()->format('Y-m-d');
            $procedures = explode(',', $itinerary->procedureR_id); // decodificando los prcocedimientos json

            $procedures_for = $request->multiselect4; // asignando los procedimientos del multiselect

            if($procedures_for != null && $procedures[0] != ''){ // Si es distinto de null
                $procedimientos= array_merge($procedures,$procedures_for);

            }elseif($procedures_for != null && $procedures[0] == ''){ 
                $procedimientos= $procedures_for;                
            }else{ 
                $procedimientos = $procedures;
            }

            if($itinerary->billing == null){
                $crear_factura = Billing::create([
                    'patient_id'  => $itinerary->patient_id,
                    'employe_id'     => $itinerary->employe_id,
                    'branch_id' => 1,
                ]);

                $itinerary->billing_id = $crear_factura->id;
                $itinerary->save();

                if($procedimientos[0] != ''){
                    for ($i=0; $i < count($procedimientos) ; $i++) { 
                        $procedure[] = Procedure::find($procedimientos[$i]);
                        $crear_factura->procedure()->attach($procedure[$i]);
                    }
                }else{ 
                    $procedure = 0;
                }
                  
            }else{
                $crear_factura = $itinerary->billing;
                $b_procedure = Billing::with('procedure')->where('id',$crear_factura->id)->first();
                foreach($b_procedure->procedure as $item) { 
                    $procedure[] = $item;
                }
            }              

            return view('dashboard.checkout.factura', compact('tipo_moneda','fecha', 'tipo_pago','procedure','itinerary','crear_factura','total'));
        }else{
            Alert::error('No puede procesar la factura');
            return redirect()->back();
        }
    }


    //============================ registrando cliente ============================ (listo)
    public function create_cliente(CreateVisitorRequest $request){
        // dd($request);
        $person = Person::create([
            'type_dni'    => $request->type_dni,
            'dni'         => $request->dni,
            'name'        => $request->name,
            'lastname'    => $request->lastname,
            'address'     => $request->address,
            'phone'       => $request->phone,
            'email'       => $request->email,
            'branch_id'   => 1,
        ]);

        return response()->json([
            'cliente' => $person,201
        ]);
    }


    //============================ imprimir factura ============================ (listo)
    public function imprimir_factura(Request $request)
    {
    //  dd($request->person_id);
        if($request->person_id != null){
            if($request->factura != null){
                
                $billing = billing::find($request->factura);
                $billing->person_id = $request->person_id;
                $billing->type_payment_id = $request->tipo_pago;
                $billing->type_currency = $request->tipo_moneda;
                $billing->save();

                $fecha = Carbon::now()->format('Y-m-d');

                $todos = Billing::with('person','employe.person','employe.doctor', 'patient', 'procedure','typepayment' , 'typecurrency')->where('id',$billing->id)->first();
                $total = 0;
                // dd($todos->employe->doctor->price);
                foreach($todos->procedure as $proce) { 
                    if($proce->name != 'Consulta médica'){
                        $total += $proce->price;
                    }
                    if($proce->name == 'Consulta médica'){
                        $total += $todos->employe->doctor->price;
                    }                    
                }
                // dd($total);

                $cirugia = Itinerary::with('person','employe.person', 'employe.doctor', 'surgeryR')->where('patient_id', $todos->patient_id )->where('employe_id',$todos->employe_id)->first();

                if($cirugia->surgeryR != null){
                    $total_cancelar = $cirugia->surgeryR->cost + $total;
                }else{
                    $total_cancelar = $total;
                }

                $num_factura = str_pad($billing->id, 5, '0', STR_PAD_LEFT);

                $pdf = PDF::loadView('dashboard.checkout.print', compact('todos','cirugia','total_cancelar','fecha', 'num_factura'));
                
                return $pdf->stream('factura.pdf');
            }else{
                Alert::error('No puede procesar la factura');
                return redirect()->back();
            }
        }else{
            Alert::error('No puede procesar la factura');
            return redirect()->back();
        }
    }

      //============================ imprimir factura ============================ (listo)
      public function imprimir_factura2($id)
      {
        $itinerary = Itinerary::with('employe','billing.procedure')->where('id',$id)->first();

        $todos = Billing::with('person','employe.person','employe.doctor', 'patient', 'procedure','typepayment' , 'typecurrency')->where('id',$itinerary->billing_id)->first();
            
        $cirugia = Itinerary::with('person','employe.person', 'employe.doctor', 'surgeryR')->where('id', $itinerary->id )->first();

        $total = 0;
        $fecha = Carbon::now()->format('Y-m-d');

        foreach($todos->procedure as $proce) { 
            if($proce->name != 'Consulta médica'){
                $total += $proce->price;
            }
            if($proce->name == 'Consulta médica'){
                $total += $todos->employe->doctor->price;
            }                       
        }

        if($cirugia->surgeryR != null){
            $total_cancelar = $cirugia->surgeryR->cost + $total;
        }else{
            $total_cancelar = $total;
        }

        $num_factura = str_pad($itinerary->billing_id, 5, '0', STR_PAD_LEFT);

        $pdf = PDF::loadView('dashboard.checkout.print', compact('todos','cirugia','total_cancelar','fecha', 'num_factura'));
        
        return $pdf->stream('factura.pdf');

    }


    //============================ imprimir examen ============================ (listo)
    public function imprimir_examen(Request $request)
    {
        $examen = explode(',', $request->id); // decodificando los prcocedimientos json
        
        $datos = Itinerary::with('person','employe.person','exam')->where('exam_id',$request->id)->first();
        for ($i=0; $i < count($examen) ; $i++) { 
            $examenes[] = Exam::find($examen[$i]); //buscando datos de cada examen
        }

        $fecha = Carbon::now()->format('Y-m-d');

        $pdf = PDF::loadView('dashboard.checkout.print_examen', compact('examenes', 'datos','fecha'));
        return $pdf->stream('examen.pdf');
    }


    //============================ imprimir recipe ============================ (listo)
    public function imprimir_recipe(Request $request, $id)
    {
        $recipe = Recipe::with('patient','employe.person', 'medicine.treatment')->where('id', $id)->first();
    
        $paciente = Patient::where('person_id',$recipe->patient->id)->first(); 
        $fecha = Carbon::now()->format('Y-d-m');

        $pdf = PDF::loadView('dashboard.checkout.print_recipe', compact('recipe', 'paciente', 'fecha'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('recipe.pdf');
    }

    //============================ imprimir referencia ============================ (listo)
    public function imprimir_referencia($id){

        $itinerary = Itinerary::with('person','employe.person','reference','diagnostic')->where('id',$id)->first();

        $especialidad = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))
        ->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')
        ->where('id', $itinerary->reservation_id )->first();
        
        $referencia = Reference::with('patient', 'employe.person', 'speciality')->where('id', $itinerary->reference_id)->first();

        $fecha = Carbon::now()->format('Y/m/d');

        $pdf = PDF::loadview('dashboard.checkout.print_referencia', compact('referencia','fecha','itinerary', 'especialidad'));
        return $pdf->stream('referencia.pdf');
    }
    
    //============================ imprimir constancia ============================
    public function imprimir_constancia($id){

        $itinerary = Itinerary::with('person','employe.person','constancy')->where('id',$id)->first();
        $especialidad = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))
        ->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')
        ->where('id', $itinerary->reservation_id )->first();      
        $fecha = Carbon::now()->format('Y/m/d');

        $pdf = PDF::loadview('dashboard.checkout.print_constancia', compact('itinerary','especialidad','fecha' ));
        return $pdf->stream('constancia.pdf');
    }

    //============================ imprimir reposo ============================ (listo)
    public function imprimir_reposo($id){

        $itinerary = Itinerary::with('person','employe.person','repose')->where('id',$id)->first();
        $especialidad = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))
        ->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')
        ->where('id', $itinerary->reservation_id )->first();
        
        $fecha = Carbon::now()->format('Y/m/d');

        $pdf = PDF::loadview('dashboard.checkout.print_reposo', compact('itinerary', 'fecha', 'especialidad'));
        return $pdf->stream('reposo.pdf');
    }


    //============================ imprimir informe ============================ (listo)
    public function imprimir_informe($id){

        $itinerary = Itinerary::with('person','employe.person','report_medico')->where('id',$id)->first();
        // dd($itinerary);
        $especialidad = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))
        ->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')
        ->where('id', $itinerary->reservation_id )->first();
        $fecha = Carbon::now()->format('Y/m/d');
        
        $pdf = PDF::loadview('dashboard.checkout.print_informe', compact('itinerary', 'especialidad', 'fecha'));
        return $pdf->stream('informe.pdf');
    }
    
    //============================ cambiar a estado fuera ============================ (listo)
    public function statusOut($itinerary_id)
    {
        $itinerary =  Itinerary::where('id', $itinerary_id)->first();
        $io = InputOutput::where('person_id', $itinerary->patient_id)->where('employe_id', $itinerary->employe_id)->first();
        // dd($io);

        $itinerary->status = 'fuera';
        $itinerary->save();

        if (empty($io->outside)) {
            $io->outside = 'fuera';
            $io->save();
            // dd($io);
        }else{
            Alert::error('Paciente ya esta dentro del consultorio');
            return redirect()->back();
        }


        Alert::success('Paciente fuera de las instalaciones');
        return redirect()->back();
    }


      //========================= Citas del dia (las que estan aprobadas) ======================
    public function index_dia()
    {
        $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
        //   $itinerary = Itinerary::all();
        //   dd($day);
        return view('dashboard.checkout.citas-pacientesDia', compact('day'));
    }

    public function store(Request $request)
    {
        
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
    // public function edit($id)
    // {
    //     //
    // }

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

    public function doctor_P(Request $request)  //procedimientos segun el medico
    {
        $doctor = Employe::with('person.user','procedures', 'doctor')->where('id', $request->id)->first();

        if ($doctor->person->user->role('doctor')) {
            return response()->json([
                'doctor' => $doctor,
            ]);
        }
    }

    public function payment()
    {
        $pay = TypePayment::all();

        if (!is_null($pay)) {
            return response()->json([
                'type_payments' => $pay,
            ]);
        }
    }

    public function curency()
    {
        $currency = TypeCurrency::all();

        if (!is_null($currency)) {
            return response()->json([
                'type_currency' => $currency,
            ]);
        }
    }

    public static function billing(CreateBillingRequest $request){  //facturacion
        
        $billing = Billing::create([
            'procedure_employe_id' => $request['procedure_employe_id'],
            'person_id' => $request['person_id'],
            'patient_id' => $request['patient_id'],
            'employe_id' => $request['employe_id'],
            'type_payment_id' => $request['type_payment_id'],
            'type_currency' => $request['type_currency'],
            'branch_id' => 1
        ]);

        return response()->json([
            'message' => 'Factura creada',
        ]);
    }


    public function recipe(Request $request)
    {
        $patient = Patient::with('medicine')->where('id', $request->id)->first();

        return response()->json([
            'recipe' => $patient,
        ]);
    }

    public function surgeries_list(){
    
    $all = Surgery::with('patient.person.image','employe.person','typesurgeries','area')->get();
    // dd($all);
    $today = Surgery::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date', 'asc')->with('patient.person.image','employe.person','typesurgeries','area')->get();
    // dd($today);
    // $approved =

    // $reschedule =

    // $canceled =

    // dd($surgeries);
    return  view('dashboard.checkout.lista_cirugias', compact('all','today'));
    }

}

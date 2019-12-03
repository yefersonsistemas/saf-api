<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Specilaity;
Use App\Employe;
Use App\Area;
Use App\Billing;
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
use App\Http\Requests\CreateVisitorRequest;
// use App\Procedure_billing;
use RealRashid\SweetAlert\Facades\Alert;

use Barryvdh\DomPDF\Facade as PDF; //alias para el componnete de pdf

class OutController extends Controller
{
   
    //=================== listando los pacientes del dia ==================
    public function index()
    {
        $procedures_id = array();
        $itinerary = Itinerary::with('person', 'employe.person', 'procedure','employe.doctor','surgery.typesurgeries','exam','recipe','reservation')->get(); // esta es una coleccion
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
        return view('dashboard.checkout.citas-pacientes', compact('itinerary'));
    }

    //====================== lista de cirugias ============================
    public function index_cirugias()
    {
        $cirugias_ambulatorias = ClassificationSurgery::with('typeSurgeries')->where('name','ambulatoria')->get();
        $cirugias_hospitalarias = ClassificationSurgery::with('typeSurgeries')->where('name','hospitalaria')->get();
        $clasificacion = ClassificationSurgery::all();

        return view('dashboard.checkout.cirugias', compact('cirugias_ambulatorias', 'cirugias_hospitalarias', 'clasificacion'));
    }

     //====================== detalles de las cirugias ============================
     public function cirugias_detalles(Request $request)
     {
        $cirugias = Surgery::with('typeSurgeries', 'procedure', 'equipment', 'hospitalization')->where('type_surgery_id', $request->id)->first();
        // dd($request->id);
         return view('dashboard.checkout.cirugias-detalles', compact('cirugias'));
     }


    //============================ buscanco paciente ============================
    public function search_patient(Request $request){

  
        if(!empty($request->dni)){ 
        
        $person = Person::where('dni', $request->dni)->first();
    
        if(!empty($person)){

            $itinerary = Itinerary::where('patient_id', $person->id)->first();
            if(!empty($itinerary)){

                $all = collect([]); //definiendo una coleccion|
                $encontrado = Itinerary::with('person', 'employe.person', 'procedure','employe.doctor','surgery.typesurgeries')->where('patient_id', $person->id)->get(); // esta es una coleccion

                $procedures = explode(',', $encontrado->last()->procedure_id); //decodificando los procedimientos en $encontrado

                if($procedures[0] != ''){ 
                    foreach ($encontrado as $proce) {  //recorriendo el arreglo de procedimientos
                    $procedures[] = $proce->procedure_id;
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

 
    //============== buscando procedimiento y mostrando en la vista para generar factura==============
    public function create(){
        $procedimientos = Procedure::all();
        return view('dashboard.checkout.facturacion', compact('procedimientos'));
    }


    //============================ buscando procedimiento ============================
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

    //============================================ guardar factura ========================================
    public function guardar_factura(Request $request)
    {
        // dd($request);
        if($request->patient_id != null && $request->employe_id != null){
            
            $total = $request->total_cancelar; // el $total_cancelar viene de la funcion ajax y se muestra en la siguiente vista
            $tipo_moneda = TypeCurrency::all();
            $tipo_pago = TypePayment::all();

            $itinerary = Itinerary::with('person', 'employe.person', 'procedure','employe.doctor','surgery.typesurgeries')->where('patient_id', $request->patient_id)->first();

                    $procedures = explode(',', $itinerary->procedure_id); // decodificando los prcocedimientos json

                    // dd($procedures);
                    $procedures_for = $request->multiselect4; // asignando los procedimientos del multiselect
        
                    // dd($procedures_for);
                    if($procedures_for != null){ // Si es distinto de null
                        $procedimientos= array_merge($procedures,$procedures_for);
                    }else{ 
                        $procedimientos = $procedures;
                    }
                    // dd($procedimientos);

                $crear_factura = Billing::create([
                    'patient_id'  => $itinerary->patient_id,
                    'employe_id'     => $itinerary->employe_id,
                    'branch_id' => 1,
                ]);
    
                if($procedimientos[0] != ''){
                    for ($i=0; $i < count($procedimientos) ; $i++) { 
                        $procedure[] = Procedure::find($procedimientos[$i]);
                        $crear_factura->procedure()->attach($procedure[$i]);
                    }
                }else{
                    $procedure = 0;
                }

            return view('dashboard.checkout.factura', compact('tipo_moneda', 'tipo_pago','procedure','itinerary','crear_factura','total'));
        }else{
            Alert::error('No puede procesar la factura');
            return redirect()->back();
        }
    }

    //============================ registrando cliente ============================
    public function create_cliente(CreateVisitorRequest $request){
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

     
    //============================ imprimir factura ============================
    public function imprimir_factura(Request $request)
    {
        if($request->person_id != null && $request->tipo_moneda != null && $request->tipo_pago != null){
            if($request->factura != null){
                
                $billing = billing::find($request->factura);
                $billing->person_id = $request->person_id;
                $billing->type_payment_id = $request->tipo_pago;
                $billing->type_currency = $request->tipo_moneda;
                $billing->save();

                $todos = Billing::with('person','employe.person','employe.doctor', 'patient', 'procedure','typepayment' , 'typecurrency')->where('id',$billing->id)->first();
            
                // dd($todos->procedure->first()->price);
                for ($i=0; $i < count($todos->procedure) ; $i++) { 
                    $total_procedure = array_sum($todos->procedure[$i]->price);
                    
                }

                dd($total_procedure);
            
                
                $cirugia = Itinerary::with('person','employe.person','surgery.typesurgeries')->where('patient_id', $todos->patient_id )->where('employe_id',$todos->employe_id)->first();
 
                // dd($todos->employe->doctor->price);
                $total_cancelar = $cirugia->surgery->typesurgeries->cost + $todos->employe->doctor->price ;
                // dd($total_cancelar);
                $pdf = PDF::loadView('dashboard.checkout.print', compact('todos','cirugia','total_cancelar'));

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


    //============================ imprimir examen ============================
    public function imprimir_examen(Request $request)
    {
        $examen = explode(',', $request->id); // decodificando los prcocedimientos json

        $datos = Itinerary::with('person','employe.person','exam')->where('exam_id',$request->id)->first();
        for ($i=0; $i < count($examen) ; $i++) { 
            $examenes[] = Exam::find($examen[$i]); //buscando datos de cada examen
        }

        $pdf = PDF::loadView('dashboard.checkout.print_examen', compact('examenes', 'datos'));
        return $pdf->stream('examen.pdf');
    }


    //============================ imprimir recipe ============================
    public function imprimir_recipe(Request $request)
    {
        $recipe = Recipe::with('patient','employe.person','medicine')->where('id', $request->id)->first();
        // dd($recipe);

        $pdf = PDF::loadView('dashboard.checkout.print_recipe', compact('recipe'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('recipe.pdf');
    }


    //============================ cambiar a estado fuera ============================
    public function statusOut($patient_id)
    {
        dd($patient_id);
        $patient = InputOutput::where('person_id', $patient_id)->first();
        $p = Patient::where('person_id', $patient->person_id)->first();
        $io = InputOutput::where('person_id', $p->person_id)->first();

        if (!empty($patient->inside) && empty($patient->outside)) {
          
            $patient->outside = 'fuera';
            $patient->save();
        }else{
            Alert::error('Paciente ya ha salido');
            return redirect()->back();
        }

        Alert::success('Paciente fuera');
        return redirect()->back();
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
}

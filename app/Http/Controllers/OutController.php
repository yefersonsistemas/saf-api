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
use RealRashid\SweetAlert\Facades\Alert;

use Barryvdh\DomPDF\Facade as PDF; //alias para el componnete de pdf

class OutController extends Controller
{
   

     //=================== listando los pacientes del dia ==================
    public function index()
    {
        // $citas_pacientes = 
        // $cites = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->get();
        // dd($cites);
        // $all = collect([]);
        $itinerary = Itinerary::with('employe', 'procedure', 'surgery.typesurgeries', 'exam', 'recipe', 'reservation', 'person')->get();
        // foreach ($itinerary as $itinerary) {
        //     $procedure[] = json_decode($itinerary->procedure_id);
        // }
        // for ($i=0; $i < count($procedure) ; $i++) { 
        //     $procedures[] = Procedure::find($procedure[$i]);
        // }
        // $all->push($procedures); 
        // dd($itinerary);

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
        
        // dd($cirugias);

         return view('dashboard.checkout.cirugias-detalles', compact('cirugias'));
     }


   //====================== para generar factura ============================
    public function create()
    {
        $procedimientos = Procedure::all();
        $itinerary = Itinerary::with('person', 'employe.person', 'procedure')->where('patient_id', 2)->get();
        // dd(json_decode($itinerary->last()->procedure_id));
      
        return view('dashboard.checkout.facturacion', compact('procedimientos'));
    }


    //============================ buscanco paciente ============================
    public function search_patient(Request $request){

        $person = Person::where('dni', $request->dni)->first();
        // dd($person->id);
          $all = collect([]);
        // $procedure = Itinerary::with('procedure')->get();
        // dd($procedure);

        // $encode = json_encode($procedure->procedure);
        // dd($encode);

        $encontrado = Itinerary::with('person', 'employe.person', 'procedure')->where('patient_id', $person->id)->get();

        $procedures = explode(',', $encontrado->last()->procedure_id);
        // dd($encontrado->procedure_id);
        // dd($procedures);

           foreach ($encontrado as $proce) {
            $procedures[] = $proce->procedure_id;
            
        }
        // dd($procedures);
        // dd($procedures);
        for ($i=0; $i < count($procedures)-1 ; $i++) { 
            $procedureS[] = Procedure::find($procedures[$i]);
        }

        $all->push($procedureS); 
        // dd($proceduress);
            // dd($proceduress[]);
        

        if (!is_null($encontrado)) {
            return response()->json([
                'encontrado' => $encontrado,201,
                'procedureS'  => $procedureS,
            ]);
        }else{
            return response()->json([
                'message' => 'No encontrado',202
            ]);
        }
    }


    //============================ buscando procedimiento ============================
    public function search_procedure($procedure_id){

        // dd($procedure_id);
        $data_procedure = Procedure::where('id', $procedure_id)->first();
        // dd($data_procedure);
    
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

       //============================ buscando procedimiento ============================
       public function create_procedure($procedure_id){

        dd($procedure_id);
        $data_procedure = Procedure::where('id', $procedure_id)->first();
        // dd($data_procedure);
    
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


     //============================ crear factura ============================
    public function create_factura()
    {
        $tipo_moneda = TypeCurrency::all();
        $tipo_pago = TypePayment::all();
        return view('dashboard.checkout.factura', compact('tipo_pago', 'tipo_moneda'));
    }

    //============================ guardar factura ============================
    public function guardar_factura(Request $request)
    {
        // dd($request);
        $tipo_moneda = TypeCurrency::all();
        $tipo_pago = TypePayment::all();
        $patient_id = $request->patient_id;
        $employe_id = $request->employe_id;
        // dd($employe_id);
        $itinerary = Itinerary::with('person', 'employe.person', 'procedure')->where('patient_id', $patient_id)->first();
        dd($itinerary);
        // dd($person_patient);

        // dd($employe_id);

        // if($patient_id && $employe_id){
        $crear_factura = Billing::create([
            'patient_id'  => $patient_id,
            'employe_id'     => $employe_id,
            'branch_id' => 1,
            ]);

            return view('dashboard.checkout.factura', compact('itinerary','tipo_pago', 'tipo_moneda'));
            // return response()->json([
            //     'factura' => $crear_factura,201
            // ]);
            //  }else{
            //     return response()->json([
            //         'factura' => 'no se pudo crear la factura',202
            //     ]);
            //  }
        // return view('dashboard.checkout.factura', compact('tipo_pago', 'tipo_moneda'));
    }
     

    //============================ cambiar a estado fuera ============================
    public function statusOut($patient_id)
    {
        // dd($id);
        $patient = InputOutput::where('person_id', $patient_id)->first();
        // dd($patient);
        $p = Patient::where('person_id', $patient->person_id)->first();
            // dd($p);
        $io = InputOutput::where('person_id', $p->person_id)->first();
        //   dd($io);

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

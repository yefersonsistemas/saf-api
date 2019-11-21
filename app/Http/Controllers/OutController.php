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

use Barryvdh\DomPDF\Facade as PDF; //alias para el componnete de pdf

class OutController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //=================== listando los pacientes del dia ==================
    public function index()
    {
        // $citas_pacientes = 
        // $cites = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->get();
        // dd($cites);
        // $all = collect([]);
        $itinerary = Itinerary::with('employe', 'patient', 'procedure', 'surgery.typesurgeries', 'exam', 'recipe', 'reservation', 'person')->get();
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.checkout.facturacion');
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

    public function statusOut(Request $request)
    {
        $patient = InputOutput::where('id', $request->id)->first();

        if (!empty($patient->inside)) {
          
            $patient->outside = 'fuera';
    
            if ($patient->save()){
               return response()->json([
                    'message' => 'Paciente fuera del consultorio', 
                ]);
            }
        }else{
            return response()->json([
                'message' => 'Ha ocurrido un error al actualizar la informacion',
            ]);
        }
    }

    public function recipe(Request $request)
    {
        $patient = Patient::with('medicine')->where('id', $request->id)->first();

        return response()->json([
            'recipe' => $patient,
        ]);
    }
}

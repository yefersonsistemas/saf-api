<?php

namespace App\Http\Controllers\API;

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
use Barryvdh\DomPDF\Facade as PDF; //alias para el componnete de pdf

class OutController extends Controller
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
        $doctor = Employe::with('person.user','procedures')->where('id', $request->id)->first();

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

    public function exams(Request $request) //falta
    {
        $patient = Patient::where('person_id', $request->person_id)->first();

        $exam = Exam::get();
        //dd($patient);
        $pdf = PDF::loadView('pdf.exam', compact('exam')); //vista generada por el componente PDF
                    //carpeta.namearchivo
        return response()->json([
            'Exams' => $pdf->download('exam.pdf'), 
        ]);
    }

    public function recipe()
    {
        $patient = Medicine::with('patient')->get();
        dd($patient);
        $pdf = PDF::loadView('pdf.recipe', compact('patient')); //vista generada por el componente PDF
                          
        return response()->json([
            'Exams' => $pdf->download('recipe.pdf'), 
        ]);
    }
}

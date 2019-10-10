<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Patient;
use App\Medicine;
use App\Exam;
use App\Diagnostic;
use App\Procedure;
use App\Surgery;
use Carbon\Carbon;
use App\Http\Requests\CreateDiagnosticRequest;
use App\Employe;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::whereDate('date', Carbon::now()->format('Y-m-d'))->get();
       // $patient = Patient::all()->dd();
       
        return response()->json([
            'patient' => $patients,
        ]);
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

    public function history_patient(Request $request){
        $patients = Patient::where('id', $request->id);
        $exam = Exam::all();   //se selecciona mediante un buscador
        $procedure = Procedure::all();
        $surgery = Surgery::all(); //informacion para posible cirugia cuando lo seleccione

        //  event(new Consult($surgery)); //se activa cuando seleccionan la cirugia

        return response()->json([
            'patient' => $patients,
            'exam' => $exam,
            'procedure' => $procedure,
            'surgery' => $surgery,
        ]);

    }

    public function diagnostic(CreateDiagnosticRequest $request){


        // return response()->json([
        //     'aa' => $request['patient_id'],
        // ]);
         //$diagnostic = Diagnostic::all()->dd();
        $diagnostic = Diagnostic::create([
            'patient_id' => $request['patient_id'],
            'description' => $request['description'],
            'reason' => $request['reason'],
            'treatment' => $request['treatment'],
            'annex' => $request['annex'],
            'next_cite' => $request['next_cite'],
            'employe_id' => $request['employe_id'],
            'branch_id'  => 1,
        ]);

            return response()->json([
                'message' => 'diagnostico agregado',
                'diagnostic' => $diagnostic,
            ]);
    }

    public function recipe(Request $request){
        $patients = Patient::where('id', $request->id);  //para mostrar los datos basicos del paciente
        $medicines = Medicine::all();  //suponiendo q esten cargadas se seleccionara las q necesitan 
        
        return response()->json([
            'patients' => $patients,
            'medicines' => $medicines,
        ]);
    }

    //falta calculo del doctor p/paciente pago semanal
    public function list()
    {
        $doctor = Employe::with('person.user','procedures')->get();

        return response()->json([
            'doctors' => $doctor,
        ]);
        

        $doctors = $doctor->each(function ($doctor)
        {
            $doc = $doctor->person->user->role('doctor');
            // $doc->load('procedures');
            return $doc;
        });

        return response()->json([
            'doctors' => $doctors,
        ]);
    }

    public function patients()
    {
        $patients = Patient::with('person')->get();
        return response()->json([
            'patients' => $patients,
        ]);
    }
    
}

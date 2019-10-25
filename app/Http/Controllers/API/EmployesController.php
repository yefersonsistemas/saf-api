<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Employe;
use App\Person;
use Illuminate\Http\Request;
use App\Patient;
use App\Position;
use App\Reservation;
Use App\Visitor;
use App\Billing;
use Carbon\Carbon;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employe = Visitor::with('person.employe.position')->where('type_visitor', 'Empleado')->get();

        return response()->json([
            'employes' => $employe,
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
        $data = $request->validate([
            'name' => 'required',
            'type_dni'  => 'required',
            'dni'   => 'required',
            'lastname' => 'required',
            'phone'     => 'required',
            'email' =>  'required',
            'address'   => 'required',
            'position_id'   => 'required',
        ]);

        $person = Person::create([
            'name' => $data['name'],
            'type_dni'  => $data['type_dni'],
            'dni'   => $data['dni'],
            'lastname' => $data['lastname'],
            'phone'     => $data['phone'],
            'email' =>  $data['email'],
            'address'   => $data['address'],
            'branch_id' => 1
        ]);

        $employe = Employe::create([
            'person_id' => $person->id,
            'position_id'   =>$request->position_id,
            'branch_id' => 1
        ]);

        return response()->json([
            'message' => 'Empleado creado',
        ]);
    }

    public function positions()
    {
        $positions = Position::all();
        return response()->json([
            'positions' => $positions,
        ]);
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

    public function statusIn(Request $request)
    {
        $person = Person::where('id', $request->id)->first(); //busco el id 
        $v = Visitor::where('person_id', $request->id)->first();  //busco q sea el mismo id q el anterior

        if (!is_null($person)) {
            $v->delete(); //como es el mismo se elimina de la lista

            $visitor = Visitor::create([       //se crea y se guarda automaticamente el cambio de estado
                'person_id' => $person->id,
                'type_visitor' => 'Empleado',
                'status' => 'dentro',
                'branch_id' => 1,
            ]);
            
            return response()->json([
                'message' => 'Empleado dentro de las instalaciones',
            ]);
        }
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
        $patients = Patient::where('id', $request->id)->first();  //para mostrar los datos basicos del paciente
        $medicines = Medicine::all();  //suponiendo q esten cargadas se seleccionara las q necesitan 
        
        return response()->json([
            'patients' => $patients,
            'medicines' => $medicines,
        ]);
    }

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

    //falta acomodar el rango de las fechas
    public function calculo_week(Request $request){  //clase A fija su precio para las consultas
        // Carbon::setWeekStartsAt(Carbon::THURSDAY);
        // Carbon::setWeekEndsAt(Carbon::FRIDAY);
        // $patient = Patient::with('employe')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        // ;

        $employe = Employe::with('person.user', 'doctor.typedoctor')->where('person_id', $request->person_id)->first();
       // dd($employe);
        $billing = Billing::where('person_id', $request->person_id)->get();
        //dd($billing);

        if($employe->person->user->role('doctor')){
          
            $total = 0;
            foreach($billing as $b){
               $total += $b->procedures->price;
            }
            return $total; 
            //dd($total);
    
            $pago = ($employes->doctor->typedoctor->comission + ($employes->doctor->price) + $total);
        }

        return response()->json([
            'pago' => $pago,
        ]);
    } 
    
    public function record_patient(Request $request){  //todos los pacientes por doctor
        $employe = Employe::with('person.user', 'patient')->where('id', $request->id)->first();

        if (!is_null($employe)) {
            
            return response()->json([
                'patients' => $employe,
               
            ]);
        }
    }

    public function patient_on_day(Request $request){  //pacientes del dia por doctor
        $patients = Reservation::with('patient')->where('person_id', $request->person_id)
                                ->whereDate('date', Carbon::now()->format('Y-m-d'))->get();

        if (!is_null($patients)) {

            return response()->json([
                'reservas' => $patients,
                
            ]);
        }
    }
}

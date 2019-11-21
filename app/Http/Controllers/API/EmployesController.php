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
use App\Assistance;
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
        $reservations = Reservation::whereDate('date', Carbon::now()->format('Y-m-d'))->get();
        $employes = Employe::get();
        //dd($employes);
        $days = array('lunes', 'martes', 'miercoles', 'jueves', 'viernes');

        $e = $employes->each( function ($employe) {
            if ($employe->position->name == 'doctor') {
                $dia = Carbon::now()->dayOfWeek;
                $employe->schedule->contains($dia);
                return $employe;
            }
        });

        if ($e->isNotEmpty()) {
            foreach ($e as $person) {
                Visitor::create([
                    'person_id' => $person->person_id,
                    'type_visitor' => 'Empleado',
                    'inside'    => null,
                    'outside'   => null,
                    'branch_id' => 1
                    ]);
                }
            }
            
        $employes = Visitor::with('person.employe.position')->whereDate('created_at', Carbon::now()->format('Y-m-d'))
                            ->where('type_visitor', 'Empleado')->get();

        return response()->json([
            'employes' => $employes,
        ]);
    }

    public function all_doctors() //muestra todos los medicos registrados en el sistema
    {
        $employes = Employe::with('image','person.user', 'position')->get();
        $em = collect([]);
        
        if ($employes->isNotEmpty()) {
            foreach($employes as $employe){
                if ($employe->position->name == 'doctor' && $employe->person->user->role('doctor')) {
                    $em->push($employe);
                }
            }

            return response()->json([
                'doctors' => $em,
            ]);
        }
    } 

    public function assistance(Request $request) //control de asistencia del medico de los dias q no asiste
    {
        $data = $request->validate([
            'employe_id' => 'required',
        ]);

        $date = Carbon::now()->format('Y-m-d');

        $cites = Assistance::where('employe_id', $request->employe_id)
                            ->whereDate('created_at', $date)->get();

        if ($cites->isEmpty()) {
            Assistance::create([
                'employe_id' => $data['employe_id'],
                'status' => 'No asistio',
                'branch_id' => 1
            ]);

            return response()->json([
                'message' => 'Medico no asistio el dia de hoy',
            ]);
        }else{
            return response()->json([
                'message' => 'Ya ha sido registrado como inasistente',
            ]);
        }


    }

    public function doctor_on_day()//medicos del dia
    {
        $employes = Employe::with('image','person.user', 'speciality', 'assistance')->get();
        $em = collect([]);
        if ($employes->isNotEmpty()) {
            foreach ($employes as $employe) {
                if ($employe->person->user->role('doctor') && $employe->position->name == 'doctor') {
                    if ($employe->schedule->isNotEmpty()) {
                        $dia = strtolower(Carbon::now()->locale('en')->dayName);
                        foreach ($employe->schedule as $schedule) {
                            if ($schedule->day == $dia) {
                                $em->push($employe);
                            }
                        }
                    }
                    
                }
            }

            return response()->json([
                'employes' => $em,
            ]);
        }
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

    public function statusIn(Request $request){
        
        $visitor = Visitor::where('person_id', $request->id)->first();
    
        if (!empty($visitor)) {
            $visitor->type_visitor = 'Empleado';
            $visitor->inside = Carbon::now();

            if ($visitor->save()){
                // event(new Security($visitor)); //envia el aviso a recepcion de que el paciente citado llego 
                return response()->json([
                    'message' => 'Empleado dentro de las instalaciones', 
                ]);
            }else{
                return response()->json([
                    'message' => 'No guardo', 
                ]);
            }
        }else{
            return response()->json([
                'message' => 'No actualizo', 
            ]);
        }
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

    // public function recipe(Request $request){
       
    //     $medicines = Medicine::all();  //suponiendo q esten cargadas se seleccionara las q necesitan 
        
    //     return response()->json([
    //         'medicines' => $medicines,
    //     ]);
    // }

    public function list()
    {
        $doctor = Employe::with('person.user','procedures')->get();

        $doctors = $doctor->each(function ($doctor)
        {
            $doctor->person->user->role('doctor');
            return $doctor;
        });

        return response()->json([
            'doctors' => $doctors,
        ]);
    }

    //falta acomodar el rango de las fechas
    public function calculo_week(Request $request){  //clase A fija su precio para las consultas
        $employe = Employe::with('person.user', 'doctor.typedoctor')->where('person_id', $request->person_id)->first();

        if ($employe->position->name != 'doctor' || !$employe->person->user->role('doctor')) {
            return response()->json([
                'message' => 'empleado no es medico',
            ]);
        }

        $inicio = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $fin = Carbon::now()->endOfWeek(Carbon::FRIDAY);

        $billing = Billing::with('procedures')->where('employe_id', $employe->id)->whereBetween('created_at', [$inicio , $fin])->get();

        $total = 0;
        foreach($billing as $b){
            foreach ($b->procedures as $procedure) {
                $total += $procedure->price;
            }
        }

        $pago = (($employe->doctor->typedoctor->comission * $employe->doctor->price) + $total);
        return response()->json([
            'pago' => $pago,
        ]);
    }
    
    public function record_patient(Request $request){  //todos los pacientes por doctor
        $employe = Employe::with('person.user', 'patient.person')->where('id', $request->id)->first();

        if (!is_null($employe)) {
            return response()->json([
                'patients' => $employe,
            ]);
        }
    } 

    public function patient_on_day(Request $request){  //pacientes del dia por doctor
        $patients = Reservation::with('patient.historyPatient')->where('person_id', $request->person_id)
                                ->whereDate('date', Carbon::now()->format('Y-m-d'))->get();
                                // dd($patients);

        if (!is_null($patients)) {
            return response()->json([
                'reservas' => $patients,
            ]);
        }
    }

    public function detail_doctor(Request $request){
        $doctor = Employe::with('person.user', 'image')->where('id', $request->id)->first();

        if (!is_null($doctor)) {
            if ($doctor->person->user->role('doctor')) {
                return response()->json([
                    'doctor' => $doctor,
                ]);   
            }

        }
    }
}

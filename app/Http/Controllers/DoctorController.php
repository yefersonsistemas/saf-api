<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\Medicine;
use App\Exam;
use App\Diagnostic;
use App\Procedure;
use App\Surgery;
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
use RealRashid\SweetAlert\Facades\Alert;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
        $patients = Reservation::with('patient.historyPatient')->where('person_id',$id )->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->get();
        return view('dashboard.doctor.index',compact('patients'));
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
        // dd($id);
        // $history = 
        $history=Reservation::with('patient.historyPatient')->where('id',$id)
        ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();
        return view('dashboard.doctor.historiaPaciente', compact('history'));
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

    public function crearDiagnostico($id){
        $patient = Person::find($id);
        $exams = Exam::all();
        return view('dashboard.doctor.crearDiagnostico', compact('patient', 'exams'));
    }

    public function crearRecipe($paciente){
        $medicines = Medicine::all();
        return view('dashboard.doctor.crearRecipe', compact('medicines','paciente'));
    }

    public function crearReferencia(Person $patient){
        $specialities = Speciality::all();
        return view('dashboard.doctor.crearReferencia', compact('patient','specialities'));
    }

    public function referenceStore(Request $request, $patient)
    {
        $person = Person::with('historyPatient')->where('id',$patient)->first();

        $data = $request->validate([
            'speciality'        =>  'required',
            'reason'            =>  'required',
        ]);

        $reference = Reference::create([
            'patient_id'    =>  $person->id,
            'specialitie_id'    =>  $data['speciality'],
            'reason'        =>  $data['reason'],
            'employe_id'    =>  $request->doctor,
            'doctor'        =>  $request->doctorExterno,
        ]);
        
        $itinerary = Itinerary::where('patient_id', $person->historyPatient->id)->first();
        if (!is_null($itinerary)) {
            $itinerary->reference_id = $reference->id;
            $itinerary->save();
        }

        Alert::success('Referencia Creada');
        return redirect()->back();
    }

    public function recipeStore(Request $request, $paciente)
    {
        $paciente = Person::find($paciente);
        $treatment = Treatment::create([
            'medicine_id'   =>  $request->medicina,
            'doses'         =>  $request->dosis,
            'duration'      =>  $request->duracion,
            'measure'       =>  $request->medida,
            'indications'   =>  $request->indicaciones,
            'branch_id'     =>  1,
        ]);

        $treatment->load('medicine');
        return response()->json($treatment);
    }

    public function storeDiagnostic(Request $request, $id)
    {
        $patient = Patient::where('person_id', $id)->first();
        // dd($request);
        $diagnostic = Diagnostic::create([
            'patient_id'    =>  $patient->id,
            'description'   =>  $request->description,
            'reason'        =>  $request->razon,
            'indications'   =>  $request->indicaciones,
            'employe_id'    =>  $patient->employe_id,
            'branch_id'     =>  1,
        ]);

        foreach ($request->multiselect4 as $examen) {
            $diagnostic->exam()->attach($examen);
        }

        $itinerary = Itinerary::where('patient_id', $patient->id)->first();
        
        if (!is_null($itinerary)) {
            $itinerary->diagnostic_id = $diagnostic->id;
            $itinerary->save();
        }


        Alert::success('diagnostico creado');
        return redirect()->back();
    }

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
     * retorna los dias que el tenga disponible
     * 
     */
    public function search_schedule(Request $request){//busca el horario del medico para agendar cita
        $employe = Employe::with('schedule')->where('id', $request->id)->first();

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
                            $available[] = array(Carbon::create($date[$i]->year, $date[$i]->month, $date[$i]->day)->format('m/d/Y')); 
                        }
                        $date[$i] = $date[$i]->addWeek();
                    }
                }

                for ($i=0; $i < count($available) ; $i++) { 
                    $availables[$i] = $available[$i][0];
                }

                return response()->json([
                    'employe'       => $employe,
                    'available'     => $availables,
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
}

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
use App\Recipe;
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

     //doctor por reservacion con su diagnostico y razon de la cita
    public function show($id)
    {
        // dd($id);
        // $history = 
        $history=Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')->where('patient_id',$id)
        ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();

        $cite = Patient::with('person.reservationPatient.speciality', 'reservation.diagnostic.treatment')
                ->where('person_id', $id)->first();

        $exams = Exam::all();

                // dd(  $cite);
            // return response()->json([
            //   'Patient' => $history,
            // ]);
        return view('dashboard.doctor.historiaPaciente', compact('history','cite', 'exams'));
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

    public function crearRecipe($paciente, $employe){

        // dd($employe);
        $medicines = Medicine::all();
        return view('dashboard.doctor.crearRecipe', compact('medicines','paciente', 'employe'));
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


    // ================================= crear recipe y guardar medicinas con tratamientos ======================================
    public function recipeStore(Request $request, $paciente, $employe)
    {
        $recipe = Recipe::with('patient','employe.person')->where('patient_id', $paciente)->where('employe_id', $employe)->first();
       
        $itinerary = Itinerary::with('person','employe.person')->where('patient_id', $paciente)->where('employe_id', $employe)->first();

        if($recipe == null){
            $crear_recipe = Recipe::create([
                'patient_id'   =>  $paciente,
                'employe_id'   =>  $employe,
                'branch_id'    =>  1,
            ]);
        }else{
            $crear_recipe = $recipe;
        }
        // $paciente = Person::find($paciente);
        $treatment = Treatment::create([
            'medicine_id'   =>  $request->medicina,
            'doses'         =>  $request->dosis,
            'duration'      =>  $request->duracion,
            'measure'       =>  $request->medida,
            'indications'   =>  $request->indicaciones,
            'recipe_id'   =>  $crear_recipe->id,
            'branch_id'     =>  1,
        ]);

        $crear_recipe->medicine()->attach($request->medicina);

        if($itinerary->recipe_id == null){
            $itinerary->recipe_id = $crear_recipe->id;
            $itinerary->save();
        }
       
        $treatment->load('medicine');
        return response()->json($treatment);
    }


    // ================================= Guardar diagnostico ======================================
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
     * retorna los dias que el no tenga disponible
     * 
     */
    public function search_schedule(Request $request){//busca el horario del medico para agendar cita
        $employe = Employe::with('schedule')->where('id', $request->id)->first();
        $available = collect([]);
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
}

<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\redirect;
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
use App\Repose;
use App\ReportMedico;
use App\InputOutput;
// use App\Redirect;

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
        $id= Auth::id();
        $empleado = Employe::where('id', $id)->first();
        $today = Reservation::with('patient.historyPatient','inputoutput')->where('person_id',$empleado->person_id )->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();
        // dd($today);
        $all = Reservation::with('patient.historyPatient')->where('person_id',$id)->get();
        $month = Reservation::with('patient.historyPatient')->where('person_id',$id )->whereMonth('date', '=', Carbon::now()->month)->get();

        $date = Carbon::now();
        $week = Reservation::with('patient.historyPatient')->where('person_id',$id)->whereBetween('date', [$date->startOfWeek()->format('Y-m-d'), $date->endOfWeek()->format('Y-m-d')])->get();
        return view('dashboard.doctor.index', compact('today','month', 'all', 'week'));
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
        $medicines = Medicine::all();
        $specialities = Speciality::all();

        $history=Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')->where('patient_id',$id)
        ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();

        $cite = Patient::with('person.reservationPatient.speciality', 'reservation.diagnostic.treatment')
                ->where('person_id', $id)->first();

        $exams = Exam::all();

                // dd(  $cite);
            // return response()->json([
            //   'Patient' => $history,
            // ]);
        return view('dashboard.doctor.historiaPaciente', compact('history','cite', 'exams','medicines','specialities'));
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


    // ================================= referir doctor ======================================
    public function referenceStore(Request $request)
    {
        //    dd($request);
        $person = Person::with('historyPatient')->where('id',$request->patient)->first();

        if($request->doctor != null  || $request->doctorExterno != null){

            if($request->speciality != null && $request->reason != null){

                $reference = Reference::create([
                    'patient_id'    =>  $person->id,
                    'specialitie_id'    =>  $request['speciality'],
                    'reason'        =>  $request['reason'],
                    'employe_id'    =>  $request->doctor,
                    'doctor'        =>  $request->doctorExterno,
                ]);

                $itinerary = Itinerary::where('patient_id', $person->id)->first();
                if (!is_null($itinerary)) {
                    $itinerary->reference_id = $reference->id;
                    $itinerary->save();
                }

                return response()->json([
                    'reference' => 'Médico referido',201
                ]);
            }else{
                return response()->json([
                    'reference' => 'Datos incompletos',202
                ]);
            }
        }{
            return response()->json([
                'reference' => 'Datos incompletos',202
            ]);
        }
    }


    // ================================= crear recipe y guardar medicinas con tratamientos ======================================
    public function recipeStore(Request $request)
    {
        $itinerary = Itinerary::with('person','employe.person','reservation')->where('reservation_id', $request->reservacion)->first();

        if($itinerary->recipe_id == null){
            
            // crear el recipe
            $crear_recipe = Recipe::create([               
                'patient_id'   =>  $itinerary->patient_id,
                'employe_id'   =>  $itinerary->employe_id,
                'branch_id'    =>  1,
            ]);

            //actualiza el campo de recipe en itinerary
            $itinerary->recipe_id = $crear_recipe->id;     
            $itinerary->save();

        }else{
            $crear_recipe = Recipe::where('id', $itinerary->recipe_id)->first();
        }

        // $paciente = Person::find($paciente);
        $treatment = Treatment::create([
            'medicine_id'   =>  $request->medicina,
            'doses'         =>  $request->dosis,
            'duration'      =>  $request->duracion,
            'measure'       =>  $request->medida,
            'indications'   =>  $request->indicaciones,
            'recipe_id'     =>  $crear_recipe->id,
            'branch_id'     =>  1,
        ]);

        $crear_recipe->medicine()->attach($request->medicina);

        $treatments = Treatment::with('medicine')->where('id', $treatment->id)->first();
        // $treatment->load('medicine');

        return response()->json($treatments);
    }


    // ================================= Guardar diagnostico ======================================
    public function storeDiagnostic(Request $request)
    {
        // dd($request);

        $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();

        $io = InputOutput::where('person_id', $itinerary->patient_id)->where('employe_id', $itinerary->employe_id)->first();
        // dd($io);
        // dd($io);
        if (empty($io->outside_office)) {
            $io->outside_office = 'fuera';
            $io->save();
            // dd($io);
        }

        // dd($itinerary);
        if($itinerary != null){

            if($request->reposop != null){
            //-------- crear reposo ---------
            $reposo = Repose::create([
                'patient_id'        =>  $request->patient_id,
                'employe_id'        =>  $request->employe_id,
                'description'       =>  $request->reposop, 
                'branch_id'         =>  1
            ]);

            $reposo_id = $reposo->id;
            $itinerary->repose_id = $reposo_id;
            $itinerary->status = 'fuera_office';
            $itinerary->save();

            }else{
                $reposo_id = null;
            }

            // dd($reposo);
    
            if($request->reporte != null){
            //------- crear informe medico -------
            $reporte = ReportMedico::create([
                'patient_id'        =>  $request->patient_id,
                'employe_id'        =>  $request->employe_id,
                'descripction'      =>  $request->reporte,
                'branch_id'         =>  1
            ]);

            $reporte_id = $reporte->id;
            $itinerary->report_medico_id = $reporte_id;
            $itinerary->status = 'fuera_office';
            $itinerary->save();
            }else{
                $reporte_id = null;
            }
            // dd($reporte);

            // ------ guardando diagnostico ------
            $diagnostic = Diagnostic::create([
                'patient_id'        =>  $request->patient_id, //esta
                'description'       =>  $request->diagnostic,  //esta
                'reason'            =>  $request->razon, //esta
                'enfermedad_actual' =>  $request->enfermedad_actual, //esta
                'examen_fisico'     =>  $request->examen_fisico,//esta
                'report_medico_id'  =>  $reporte_id, //esta
                'repose_id'         =>  $reposo_id,  //esta
                'indications'       =>  $request->indicaciones, //esta
                'employe_id'        =>  $request->employe_id, //esta
                'branch_id'         =>  1,
            ]);


            // foreach ($request->multiselect4 as $examen) {
            //     $diagnostic->exam()->attach($examen);
            // }

            // dd($itinerary);
        
            Alert::success('Diagnostico creado exitosamente!');
            return redirect()->route('doctor.index');

        }else{
            Alert::error('No se pudo generar su diagnostico!');
            return redirect()->back();
        }
    }

       // ================================= Guardar diagnostico ======================================
    //    public function storeDiagnostic(Request $request, $id)
    //    {
    //        $patient = Patient::where('person_id', $id)->first();
    //        $diagnostic = Diagnostic::create([
    //            'patient_id'    =>  $patient->id,
    //            'description'   =>  $request->description,
    //            'reason'        =>  $request->razon,
    //            'indications'   =>  $request->indicaciones,
    //            'employe_id'    =>  $patient->employe_id,
    //            'branch_id'     =>  1,
    //        ]);
    //        foreach ($request->multiselect4 as $examen) {
    //            $diagnostic->exam()->attach($examen);
    //        }
    //        $itinerary = Itinerary::where('patient_id', $patient->id)->first();
    //        if (!is_null($itinerary)) {
    //            $itinerary->diagnostic_id = $diagnostic->id;
    //            $itinerary->save();
    //        }
    //        Alert::success('diagnostico creado');
    //        return redirect()->back();
    //    }

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
        // dd($request->id);
        $employe = Employe::with('schedule')->where('id', $request->id)->first();
        // dd($employe);
        $available = collect([]);
        // dd($available);
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
                // dd($total);
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

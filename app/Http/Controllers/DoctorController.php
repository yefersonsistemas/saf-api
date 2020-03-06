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
use App\Typesurgery;
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
use App\Allergy;
use App\User;
use App\File;

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
        $empleado = Employe::with('person')->where('id', $id)->first();

        $today = Reservation::with('patient.historyPatient','patient.inputoutput')->where('person_id',$empleado->person_id )->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();
// dd($today);
        $all = Reservation::with('patient.historyPatient')->where('person_id',$empleado->person_id )->get();

        $month = Reservation::with('patient.historyPatient')->where('person_id',$empleado->person_id  )->whereMonth('date', '=', Carbon::now()->month)->get();

        $date = Carbon::now();
        $week = Reservation::with('patient.historyPatient')->where('person_id',$empleado->person_id )->whereBetween('date', [$date->startOfWeek()->format('Y-m-d'), $date->endOfWeek()->format('Y-m-d')])->get();

        $fecha= Carbon::now()->format('Y/m/d h:m:s'); //la h en minuscula muestra hora normal, y en mayuscula hora militar

        //esto es para los contadores del doctor
        $mes = Carbon::now()->format('m');
        $año = Carbon::now()->format('Y');
        $reserva1 = Reservation::where('person_id', $empleado->person_id )->whereMonth('created_at', '=', $mes)->get();
        $reserva2 = Reservation::where('person_id', $empleado->person_id )->whereYear('created_at', '=', $año)->get(); //todas del mismo año
        // dd($reserva2);
        $todas = $reserva1->intersect($reserva2)->count();  //arroja todas del mes y mismo año
        // dd($todas);
        $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
        $yasevieron = collect([]);

        // dd($today->last()->patient->historyPatient->diagnostic->first());
        foreach ($day as $key) {
            if (!empty($key->patient->inputoutput->first()->inside_office) && !empty($key->patient->inputoutput->first()->inside) && !empty($key->patient->inputoutput->first()->outside_office)){
               $yasevieron->push($key);
            }
        }
        return view('dashboard.doctor.index', compact('today','month', 'all', 'week', 'fecha', 'todas', 'reserva2', 'yasevieron'));
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

     //============= doctor por reservacion con su diagnostico y razon de la cita ============
    public function show($id)
    {
        // dd($id);

        //esto es para los contadores del doctor
        $ide= Auth::id();
        // dd($id);
        $empleado = Employe::with('person')->where('id', $ide)->first();
        $today = Reservation::with('patient.historyPatient','patient.inputoutput')->where('person_id',$empleado->person_id )->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();
        $mes = Carbon::now()->format('m');
        $año = Carbon::now()->format('Y');
        $reserva1 = Reservation::where('person_id', $empleado->person_id )->whereMonth('created_at', '=', $mes)->get();
        $reserva2 = Reservation::where('person_id', $empleado->person_id )->whereYear('created_at', '=', $año)->get(); //todas del mismo año

        $todas = $reserva1->intersect($reserva2)->count();  //arroja todas del mes y mismo año
        // dd($todas);
        $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
        $yasevieron = collect([]);

        // dd($today->last()->patient->historyPatient->diagnostic->first());
        foreach ($day as $key) {
            if (!empty($key->patient->inputoutput->first()->inside_office) && !empty($key->patient->inputoutput->first()->inside) && !empty($key->patient->inputoutput->first()->outside_office)){
               $yasevieron->push($key);
            }
        }
        //==========hasta aqui los contadores=============

        $medicines = Medicine::all();
        $specialities = Speciality::all();
        $history = Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')->where('id',$id)
        ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();

        $employe = Employe::where('person_id',$history->person_id)->first();
        $patient = Patient::where('person_id',$history->patient_id)->first();

        $buscar_diagnostic = Diagnostic::where('reservation_id', $history->id)->first();
        // dd($buscar_diagnostic);

         // ------ guardando diagnostico ------
         if($buscar_diagnostic == null){
            $diagnostic = Diagnostic::create([
                'patient_id'        =>  $patient->id, //esta
                'employe_id'        =>  $employe->id, //esta
                'reservation_id'        =>  $history->id, //esta
                'status'            => false,
                'branch_id'         =>  1,
            ]);

            // dd($diagnostic);
         }

        $reservation = Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')
        ->where('id',$history->id)->first();
        // dd($reservation->person);

        $cite = Patient::with('person.reservationPatient.speciality', 'reservation.diagnostic.treatment')
        ->where('person_id', $reservation->patient_id)->first();

        $b_patient = Patient::where('person_id', $reservation->patient_id)->first();
        $employe = Employe::where('person_id', $reservation->person_id)->first();

        $r_patient = Diagnostic::with('repose', 'reportMedico','exam','procedures')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('patient_id', $b_patient->id)->where('employe_id', $employe->id)->first();
// dd($r_patient);
        $itinerary = Itinerary::with('recipe.treatment.medicine', 'typesurgery','reference.speciality','reference.employe.person')->where('reservation_id', $history->id)->first();
// dd($itinerary->recipe);
        $speciality = Speciality::all();
        $medicines = Medicine::all();
        $enfermedades = Disease::all();

        $file = File::where('fileable_id', $cite->person_id)->get();


        //---------------------mostrar enfermedades-----------------
        if($reservation->patient->historyPatient->disease->first() != null && $enfermedades != null){
            $enfermedad = $enfermedades->diff($reservation->patient->historyPatient->disease);
        }else{
            $enfermedad = Disease::all();
        }

         //----------------mostrar alergias---------------
         $alergias = Allergy::all();

           if($reservation->patient->historyPatient->allergy->first() != null && $alergias != null){
            $alergia = $alergias->diff($reservation->patient->historyPatient->allergy);
         }else{
             $alergia = Allergy::all();
         }

        foreach($speciality as $item){
            $data[] = $item->id;
        }

        //-----------------datos de la referencia-----------------
        if($itinerary->reference_id != null){
            //mostrar especialidad en el editar de referir medico
            $buscar = Speciality::find($itinerary->reference->speciality->id);
            $buscar_id[] = $buscar->id; //id de especialidad

            $diff_R = array_diff($data, $buscar_id); //diferencia de especialidades

            //mostrar empleados en el editar rederir medico para que no se repitan los datos
            $empleados = Speciality::with('employe.person')->where('id', $buscar->id)->first();

            foreach($empleados->employe as $item){
                $data2[] = $item->id;  //medicos relacionados a la especialidad
            }

            if($itinerary->reference->employe_id != null){
                    $buscarE_id[] =  $itinerary->reference->employe->id;
                    $diff_EM = array_diff($data2, $buscarE_id); //diferencia de medicos
                    if($diff_EM != []){
                        foreach($diff_EM as $di) {
                            $diff2[] = Employe::with('person')->where('id',$di)->first();
                        }
                    }else{
                        $diff2 = [];
                    }

                    $diff_doctor = null;
            }else{
                $diff_doctor = $itinerary->reference->doctor;
                $diff2 = [];
            }

        }else{
            $diff_R = $data;
        }

        //buscar datos de las especialidades
        if($diff_R != [] ){
            foreach($diff_R as $di) {
                $diff22[] = Speciality::find($di);
            }
        }else{
            $diff22 = [];
        }

        $diff = $diff22;

         //decodificando y buscando datos de procedures realizados
            if (!empty($itinerary->procedure_id)) {
                $proceduresP_id = explode(',', $itinerary->procedure_id); //decodificando los procedimientos en $encontrado
                if (!empty($proceduresP_id)) {
                    foreach($proceduresP_id as $procedure){
                        $procedures[] = Procedure::find($procedure);
                    }
                }
            }else{
                $procedures = null;
            }

            //decodificando y buscando datos de examenes
            if (!empty($itinerary->exam_id)) {
                $exam_id = explode(',', $itinerary->exam_id); //decodificando los procedimientos en $encontrado
                if (!empty($exam_id)) {
                    foreach($exam_id as $exam){
                        $exams[] = Exam::find($exam);
                    }
                }
            }else{
                $exams = null;
            }

            $procesm = Employe::with('procedures')->where('person_id', $reservation->person_id)->first();
            $examenes = Exam::all();
            $cirugias = TypeSurgery::get();

        // buscando diferencia de procedimientos realizados
            if (!empty($itinerary->procedureR_id)) {
                $diff_PR = $procesm->procedures->diff($r_patient->procedures);
            }else{
                $diff_PR = $procesm->procedures;
            }
        // buscando diferencia de examenes
            if ($itinerary->exam_id != null) {
                $diff_E = $examenes->diff($exams);
            }else{
                $diff_E = $examenes;
            }

        // busacndo posibles procedimientos
            if (!empty($itinerary->procedure_id)) {
                $diff_P = $procesm->procedures->diff($procedures);
            }else{
                $diff_P = $procesm->procedures;
            }

        // buscando posibles cirugias
            $surgery = array($itinerary->typesurgery);
            if(!empty($itinerary->typesurgery)){
                $diff_CC = $cirugias->diff($surgery);
            }else{
                $diff_CC = $cirugias;
            }

            foreach($diff_CC as $item){
                $diff_C[] = TypeSurgery::with('classification')->find($item->id);
            }


            // dd($diagnostic->status);
        return view('dashboard.doctor.editar', compact('speciality','r_patient','procedures', 'exams', 'reservation','cite','procesm','diff_PR', 'diff_E', 'diff_P', 'itinerary','medicines','diff_C','surgery','diff','diff2','diff_doctor','enfermedad','alergia','file', 'todas', 'reserva2', 'today', 'yasevieron'));

   }

//    public function revisar(){
//        $id= Auth::id();

//     $d= Diagnostic::where('status', false)->get();

//     dd($d);
// }


//     public function show($id)
//     {
//         $medicines = Medicine::all();
//         $specialities = Speciality::all();
//         $history = Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')->where('id',$id)
//         ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();
//  // dd($history->patient->historyPatient->disease);
//         // //----------------mostrar enfermedades----------
//         $enfermedades = Disease::all();

//         if($history->patient->historyPatient->disease->first() != null){
//             foreach($enfermedades as $item){
//                 $array1[] = $item->id;
//             }

//             foreach($history->patient->historyPatient->disease as $item){
//                 $array2[] = $item->id;
//             }

//             $diff = array_diff($array1, $array2);

//             if($diff != null){
//                 foreach($diff as $item){
//                     $enfermedad[] = Disease::find($item);
//                 }
//             }else{
//                 $enfermedad = [];
//             }

//         }else{
//             $enfermedad = Disease::all();
//         }

//         // //----------------mostrar alergias---------------
//           $alergias = Allergy::all();

//           if($history->patient->historyPatient->allergy->first() != null){
//             foreach($alergias as $item){
//                 $array1[] = $item->id;
//             }

//             foreach($history->patient->historyPatient->allergy as $item){
//                 $array2[] = $item->id;
//             }

//             $diff_A = array_diff($array1, $array2);
//             if($diff_A != []){
//                 foreach($diff_A as $item){
//                     $alergia[] = Allergy::find($item);

//                 }
//             }else{
//                 $alergia = [];
//             }

//         }else{
//             $alergia = Allergy::all();
//         }

//         // //-------------mostrar cirugias--------------

//         $procesm = Employe::with('procedures')->where('person_id', $history->person_id)->first();

//         // dd($procesm->procedures);
//         $cite = Patient::with('person.reservationPatient.speciality', 'person.file', 'reservation.diagnostic.treatment')
//             ->where('person_id', $id)->first();

//             // dd($cite->person->reservationPatient);

//         $persona = Person::where('id', $cite->person_id)->first();
//         // dd($person);
//         $file = File::where('fileable_id', $persona->id)->get();
//         // dd($file->first());

//         $exams = Exam::all();

//         $surgerys = Typesurgery::all();



//         // //--------------esto es para los contadores que aparecen en historia medica--------------
//         $id= Auth::id();
//         $empleado = Employe::with('person')->where('id', $id)->first();
//         $today = Reservation::with('patient.historyPatient','patient.inputoutput')->where('person_id',$empleado->person_id )->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();

//         $mes = Carbon::now()->format('m');
//         $año = Carbon::now()->format('Y');
//         $reserva1 = Reservation::where('person_id', $empleado->person_id )->whereMonth('created_at', '=', $mes)->get();
//         $reserva2 = Reservation::where('person_id', $empleado->person_id )->whereYear('created_at', '=', $año)->get(); //todas del mismo año
//         $todas = $reserva1->intersect($reserva2)->count();  //arroja todas del mes y mismo año

//         $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
//         $yasevieron = collect([]);

//         foreach ($day as $key) {
//             if (!empty($key->patient->inputoutput->first()->inside_office) && !empty($key->patient->inputoutput->first()->inside) && !empty($key->patient->inputoutput->first()->outside_office)){
//                $yasevieron->push($key);
//             }
//         }

//         return view('dashboard.doctor.historiaPaciente', compact('history','cite', 'exams','medicines','specialities', 'surgerys', 'procesm', 'enfermedad','alergia', 'today', 'todas', 'reserva2', 'yasevieron', 'file'));
//     }

      // ================= Redireccion a formulario para crear diagnostico ==============
    public function crearDiagnostico($id){
        $patient = Person::find($id);
        $exams = Exam::all();

        return view('dashboard.doctor.crearDiagnostico', compact('patient', 'exams'));
    }

    // ================================= Guardar diagnostico ====================================== no se esta usando.
    public function storeDiagnostic(Request $request)
    {
          $itinerary = Itinerary::where('reservation_id', $request->reservacion_id)->first();
          $reservation = Reservation::where('id', $request->reservacion_id)->first();
          $patient = Patient::where('person_id', $reservation->patient_id)->first();

          if($itinerary != null){
              $io = InputOutput::where('person_id', $itinerary->patient_id)->where('employe_id', $itinerary->employe_id)->first();
            // dd($io);
              if (empty($io->outside_office) && (!empty($io->inside_office))) {

                  $io->outside_office = 'fuera';
                  $io->save();
                  $itinerary->status = 'fuera_office';

                  //guardar proxima cita
                  if($request->proximaCita == 1){
                      $itinerary->proximaCita = 'posible';
                  }else{
                      $itinerary->proximaCita = null;
                  }
                  $itinerary->save();


                  if($itinerary != null){

                      if($request->reposop != null){
                      //-------- crear reposo ---------
                      $reposo = Repose::create([
                          'patient_id'        =>  $request->patient_id,
                          'employe_id'        =>  $itinerary->employe_id,
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

                      if($request->reporte != null){
                      //------- crear informe medico -------
                      $reporte = ReportMedico::create([
                          'patient_id'        =>  $patient->id,
                          'employe_id'        =>  $itinerary->employe_id,
                          'descripction'      =>  $request->reporte,
                          'branch_id'         =>  1
                      ]);

                      $reporte_id = $reporte->id;
                      $itinerary->report_medico_id = $reporte_id;
                      $itinerary->save();
                      }else{
                          $reporte_id = null;
                      }

                      // ------ guardando diagnostico ------
                      $diagnostic = Diagnostic::create([
                          'patient_id'        =>  $patient->id, //esta
                          'description'       =>  $request->diagnostic,  //esta
                          'reason'            =>  $request->razon, //esta
                          'enfermedad_actual' =>  $request->enfermedad_actual, //esta
                          'examen_fisico'     =>  $request->examen_fisico,//esta
                          'report_medico_id'  =>  $reporte_id, //esta
                          'repose_id'         =>  $reposo_id,  //esta
                          'indications'       =>  $request->indicaciones, //esta
                          'employe_id'        =>  $itinerary->employe_id, //esta
                          'branch_id'         =>  1,
                      ]);


                      //--------------Guardando examenes------------
                      if(!empty($itinerary->exam_id)){
                          $examen  =  explode(',', $itinerary->exam_id);
                          for ($i=0; $i < count($examen) ; $i++) {
                              $exam = Exam::find($examen[$i]);
                              $exam->diagnostic()->sync($diagnostic);
                          }
                      }

                      //--------------Guardando procedimientos realizados------------
                      if(!empty($itinerary->procedureR_id)){
                          $procedure  =  explode(',', $itinerary->procedureR_id);
                          for ($i=0; $i < count($procedure) ; $i++) {
                              $proce = Procedure::find($procedure[$i]);
                              $proce->diagnostic()->sync($diagnostic);
                          }
                      }


                      Alert::success('Diagnostico creado exitosamente!');
                      return redirect()->route('doctor.index');

                  }else{
                      Alert::error('No se pudo generar su diagnostico 3!');
                      return redirect()->back();
                  }
              }else{
                  Alert::error('No se pudo generar su diagnostico 2!');
                  return redirect()->back();
              }
          }else{
              Alert::error('No se pudo generar su diagnostico 1!');
              return redirect()->back();
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // ======================== actualizacion de historia ======================
    public function edit($id)
    {
        // dd($id);

         //esto es para los contadores del doctor
         $ide= Auth::id();
         // dd($id);
         $empleado = Employe::with('person')->where('id', $ide)->first();
         $today = Reservation::with('patient.historyPatient','patient.inputoutput')->where('person_id',$empleado->person_id )->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();
         $mes = Carbon::now()->format('m');
         $año = Carbon::now()->format('Y');
         $reserva1 = Reservation::where('person_id', $empleado->person_id )->whereMonth('created_at', '=', $mes)->get();
         $reserva2 = Reservation::where('person_id', $empleado->person_id )->whereYear('created_at', '=', $año)->get(); //todas del mismo año

         $todas = $reserva1->intersect($reserva2)->count();  //arroja todas del mes y mismo año
         // dd($todas);
         $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
         $yasevieron = collect([]);

         // dd($today->last()->patient->historyPatient->diagnostic->first());
         foreach ($day as $key) {
             if (!empty($key->patient->inputoutput->first()->inside_office) && !empty($key->patient->inputoutput->first()->inside) && !empty($key->patient->inputoutput->first()->outside_office)){
                $yasevieron->push($key);
             }
         }
         //==========hasta aqui los contadores=============


        $reservation = Reservation::with('patient.historyPatient.disease', 'patient.historyPatient.allergy', 'patient.historyPatient.surgery')
        ->where('id',$id)->first();
        // dd($reservation->person);

        $cite = Patient::with('person.reservationPatient.speciality', 'reservation.diagnostic.treatment')
        ->where('person_id', $reservation->patient_id)->first();

        $b_patient = Patient::where('person_id', $reservation->patient_id)->first();
        $employe = Employe::where('person_id', $reservation->person_id)->first();

        $r_patient = Diagnostic::with('repose', 'reportMedico','exam','procedures')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('patient_id', $b_patient->id)->where('employe_id', $employe->id)->first();

        $itinerary = Itinerary::with('recipe.treatment.medicine', 'typesurgery','reference.speciality','reference.employe.person')->where('patient_id', $reservation->patient_id)->first();
// dd($itinerary->recipe->treatment);
        $speciality = Speciality::all();
        $medicines = Medicine::all();
        $enfermedades = Disease::all();

        // $persona = Person::where('id', $cite->person_id)->first();
        // dd($person);
        $file = File::where('fileable_id', $cite->person_id)->get();


        //---------------------mostrar enfermedades-----------------
        if($reservation->patient->historyPatient->disease->first() != null && $enfermedades != null){
            $enfermedad = $enfermedades->diff($reservation->patient->historyPatient->disease);
        }else{
            $enfermedad = Disease::all();
        }

         //----------------mostrar alergias---------------
         $alergias = Allergy::all();

           if($reservation->patient->historyPatient->allergy->first() != null && $alergias != null){
            $alergia = $alergias->diff($reservation->patient->historyPatient->allergy);
         }else{
             $alergia = Allergy::all();
         }

        foreach($speciality as $item){
            $data[] = $item->id;
        }

        //-----------------datos de la referencia-----------------
        if($itinerary->reference_id != null){
            //mostrar especialidad en el editar de referir medico
            $buscar = Speciality::find($itinerary->reference->speciality->id);
            $buscar_id[] = $buscar->id; //id de especialidad

            $diff_R = array_diff($data, $buscar_id); //diferencia de especialidades

            //mostrar empleados en el editar rederir medico para que no se repitan los datos
            $empleados = Speciality::with('employe.person')->where('id', $buscar->id)->first();

            foreach($empleados->employe as $item){
                $data2[] = $item->id;  //medicos relacionados a la especialidad
            }

            if($itinerary->reference->employe_id != null){
                    $buscarE_id[] =  $itinerary->reference->employe->id;
                    $diff_EM = array_diff($data2, $buscarE_id); //diferencia de medicos
                    if($diff_EM != []){
                        foreach($diff_EM as $di) {
                            $diff2[] = Employe::with('person')->where('id',$di)->first();
                        }
                    }else{
                        $diff2 = [];
                    }

                    $diff_doctor = null;
            }else{
                $diff_doctor = $itinerary->reference->doctor;
                $diff2 = [];
            }

        }else{
            $diff_R = $data;
        }

        //buscar datos de las especialidades
        if($diff_R != [] ){
            foreach($diff_R as $di) {
                $diff22[] = Speciality::find($di);
            }
        }else{
            $diff22 = [];
        }

        $diff = $diff22;

         //decodificando y buscando datos de procedures realizados
            if (!empty($itinerary->procedure_id)) {
                $proceduresP_id = explode(',', $itinerary->procedure_id); //decodificando los procedimientos en $encontrado
                if (!empty($proceduresP_id)) {
                    foreach($proceduresP_id as $procedure){
                        $procedures[] = Procedure::find($procedure);
                    }
                }
            }else{
                $procedures = null;
            }

            //decodificando y buscando datos de examenes
            if (!empty($itinerary->exam_id)) {
                $exam_id = explode(',', $itinerary->exam_id); //decodificando los procedimientos en $encontrado
                if (!empty($exam_id)) {
                    foreach($exam_id as $exam){
                        $exams[] = Exam::find($exam);
                    }
                }
            }else{
                $exams = null;
            }

            $procesm = Employe::with('procedures')->where('person_id', $reservation->person_id)->first();
            $examenes = Exam::all();
            $cirugias = TypeSurgery::get();

        // buscando diferencia de procedimientos realizados
            if (!empty($itinerary->procedureR_id)) {
                $diff_PR = $procesm->procedures->diff($r_patient->procedures);
            }else{
                $diff_PR = $procesm->procedures;
            }
        // buscando diferencia de examenes
            if ($itinerary->exam_id != null) {
                $diff_E = $examenes->diff($exams);
            }else{
                $diff_E = $examenes;
            }

        // busacndo posibles procedimientos
            if (!empty($itinerary->procedure_id)) {
                $diff_P = $procesm->procedures->diff($procedures);
            }else{
                $diff_P = $procesm->procedures;
            }

        // buscando posibles cirugias
            $surgery = array($itinerary->typesurgery);
            if(!empty($itinerary->typesurgery)){
                $diff_CC = $cirugias->diff($surgery);
            }else{
                $diff_CC = $cirugias;
            }

            foreach($diff_CC as $item){
                $diff_C[] = TypeSurgery::with('classification')->find($item->id);
            }

        return view('dashboard.doctor.editar', compact('speciality','r_patient','procedures', 'exams', 'reservation','cite','procesm','diff_PR', 'diff_E', 'diff_P', 'itinerary','medicines','diff_C','surgery','diff','diff2','diff_doctor','enfermedad','alergia','file', 'todas', 'reserva2', 'today', 'yasevieron'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



     //=============================== actualizar diagnostico =============================
    public function update(Request $request, $id)
    {
        // dd($request);
        //buscar reservacion
            $reservation = Reservation::where('id',$id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->first();

        //buscando reservacion en itinerary
            $itinerary = Itinerary::where('reservation_id',$reservation->id)->first();

            $io = InputOutput::where('person_id', $itinerary->patient_id)->where('employe_id', $itinerary->employe_id)->first();
            // dd($io);

            $employe  = Reservation::with('patient.inputoutput')->where('person_id', $reservation->person_id)->where('id' , '<>', $reservation->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();

            $pacientes = array();
            // dd($employe);
            foreach($employe as $em){
                // dd($em);
                // dd($em->patient->inputoutput->first());
                if(!empty($em->patient->inputoutput->first())){
                   if($em->patient->inputoutput->first()->activo == null && $em->patient->inputoutput->first()->outside_office == null){
                      $pacientes[] = $em;
                  }
                }
            }
            // dd($pacientes);

              if (empty($io->outside_office) && (!empty($io->inside_office))) {
                // dd($io);
                  $io->outside_office = 'fuera';
                  $io->activo = false;
                  $io->save();
                  $itinerary->status = 'fuera_office';


                //   $medicos = array();
                //   $dia = strtolower(Carbon::now()->locale('en')->dayName);
                  // dd($dia);


                  //buscando pacientes que atenderan los medicos que atenderan citas hoy

                  $active  = null;
                  if($pacientes != []){
                    for($i=0; $i < count($pacientes); $i++){

                        if( $active  == null){
                            $active = $pacientes[$i];
                        }elseif($active->patient->inputoutput->first()->created_at->format('H:i:s')  >  $pacientes[$i]->patient->inputoutput->first()->created_at->format('H:i:s')){
                                $active = $pacientes[$i];

                      }
                }
                $itin = InputOutput::where('id',$active->patient->inputoutput->first()->id)->first();
                $itin->activo =true;
                $itin->save();
                  }



              }

        //buscando el id del paciente para buscar diagnostico
            $b_patient = Patient::where('person_id', $reservation->patient_id)->first();

        //buscando diagnostico
            // $diagnostic = Diagnostic::whereDate('created_at', Carbon::now()->format('Y-m-d'))
            // ->where('patient_id', $b_patient->id)->where('employe_id', $itinerary->employe_id)->first();

              $diagnostic = Diagnostic::whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->where('reservation_id', $id)->first();

        //actualizando campo de proxima cita
            if($request->proximaCita == 1){
                $itinerary->proximaCita = 'posible';
            }else{
                $itinerary->proximaCita = null;
            }
            $itinerary->save();

       //actualizando campos de diagnostico
            $diagnostic->description = $request->diagnostic;
            $diagnostic->reason = $request->razon;
            $diagnostic->enfermedad_actual = $request->enfermedad;
            $diagnostic->examen_fisico = $request->examen_fisico;
            $diagnostic->indications = $request->indicaciones;
            $diagnostic->status = true;
            $diagnostic->save();


        //actualizacion de reposo
            if($request->reposo_id != null){
                $reposo = Repose::find($request->reposo_id);
                $reposo->description = $request->reposop;
                $reposo->save();
            }

        //crear reposo y actualizar campo en itinerary y diagnostico
            if($request->reposop != null && $request->reposo_id == null){
                $reposo = Repose::create([
                    'patient_id'        =>  $reservation->patient_id,
                    'employe_id'        =>  $itinerary->employe_id,
                    'description'       =>  $request->reposop,
                    'branch_id'         =>  1
                ]);

                $itinerary->repose_id = $reposo->id;
                $itinerary->save();
                $diagnostic->repose_id = $reposo->id;
                $diagnostic->save();
            }

        //actualizacion de reporte medico
            if($request->report_medico_id != null){
                $reporte = ReportMedico::find($request->report_medico_id);
                $reporte->descripction = $request->reporte;
                $reporte->save();
            }

        //crear reporte medico y actualizar campo en itinerary y diagnostico
            if($request->reporte != null && $request->report_medico_id == null){
                $reporte = ReportMedico::create([
                    'patient_id'        =>  $b_patient->id,
                    'employe_id'        =>  $itinerary->employe_id,
                    'descripction'      =>  $request->reporte,
                    'branch_id'         =>  1
                ]);

                $itinerary->report_medico_id = $reporte->id;
                $itinerary->save();
                $diagnostic->report_medico_id = $reporte->id;
                $diagnostic->save();
            }

            return redirect()->route('doctor.index')->withSuccess('Historia actualizada');
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


    // ================= Redireccion a formulario para crear recipe ==============
    public function crearRecipe($paciente, $employe){
        $medicines = Medicine::all();
        return view('dashboard.doctor.crearRecipe', compact('medicines','paciente', 'employe'));
    }

    // ================================= crear recipe y guardar medicinas con tratamientos ======================================
    public function recipeStore(Request $request)
    {
        $itinerary = Itinerary::with('person','employe.person','reservation')->where('reservation_id', $request->reservacion)->first();

        if(!empty($itinerary)){
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

            $medicine = Medicine::where('name', $request->medicina)->first();
            // $paciente = Person::find($paciente);
            $treatment = Treatment::create([
                'medicine_id'   =>  $medicine->id,
                'doses'         =>  $request->dosis,
                'duration'      =>  $request->duracion,
                'measure'       =>  $request->medida,
                'indications'   =>  $request->indicaciones,
                'recipe_id'     =>  $crear_recipe->id,
                'branch_id'     =>  1,
            ]);

            $crear_recipe->treatment()->attach($treatment);

            $treatments = Treatment::with('medicine')->where('id', $treatment->id)->first();

            // dd($treatments);
            return response()->json($treatments);
        }else{
            return response()->json([
                'recipe' => 'No se pudo generar recipe', 202,
            ]);
        }
    }

    // ================= Redireccion a formulario para crear referencia ==============
    public function crearReferencia(Person $patient){
        $specialities = Speciality::all();
        return view('dashboard.doctor.crearReferencia', compact('patient','specialities'));
    }

    // ================================= referir doctor ======================================
    public function referenceStore(Request $request)
    {
        $person = Person::with('historyPatient')->where('id',$request->patient)->first();
        $io = InputOutput::where('person_id', $person->id)->first();

        if (!empty($io->inside) && !empty($io->inside_office) && empty($io->outside_office) && empty($io->outside) ) {

            if($request->doctor != null  || $request->doctorExterno != null){

                if($request->speciality != null && $request->reason != null){

                    $reference = Reference::create([
                        'patient_id'    =>  $person->id,
                        'specialitie_id'    =>  $request['speciality'],
                        'reason'        =>  $request['reason'],
                        'employe_id'    =>  $request->doctor,
                        'doctor'        =>  $request->doctorExterno,
                    ]);

                    $itinerary = Itinerary::where('reservation_id', $request->reservation_id)->first();
                    // dd($itinerary);
                    if (!empty($itinerary)) {
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
         }else{
            return response()->json([
                'reference' => 'No se pudo generar su referencia',202
            ]);
         }
    }

       // ================================= referir doctor ======================================
       public function reference_update(Request $request)
       {
        //    dd($request);
           $referencia = Reference::find($request->reference);

               if($request->doctor != null  || $request->doctorExterno != null){

                   if($request->speciality != null && $request->reason != null){

                        if($referencia != null){
                            $referencia->specialitie_id = $request->speciality;
                            $referencia->doctor = $request->doctorExterno;
                            $referencia->employe_id = $request->doctor;
                            $referencia->reason = $request->reason;
                            $referencia->save();
                            return response()->json([
                                'reference' => 'Referencia actualizada correctamente',201,$referencia,
                            ]);

                        }else{
                            $referencia = Reference::create([
                                'patient_id'    =>  $request->patient,
                                'specialitie_id'    =>  $request->speciality,
                                'reason'        =>  $request->reason,
                                'employe_id'    =>  $request->doctor,
                                'doctor'        =>  $request->doctorExterno,
                                'branch'        =>  1,
                            ]);

                            $itinerary = Itinerary::where('reservation_id', $request->reservation_id)->first();
                            // dd($itinerary);
                            if (!empty($itinerary)) {
                                $itinerary->reference_id = $referencia->id;
                                $itinerary->save();
                            }

                            return response()->json([
                                'reference' => 'Referencia actualizada correctamente',201, $referencia,
                            ]);
                    }

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


    //============================== buscar doctor =====================
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

     //======================== buscando horario ====================
    public function search_schedule(Request $request){//busca el horario del medico para agendar cita
            // dd($request->id);
        $employe = Employe::with('schedule')->where('id', $request->id)->first();
        // dd($employe->schedule);
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

    //=================Lista de las Cirugias Asociada al Doctor====================
    public function surgeries_list(){

        $id = Auth::id();
        $person = User::find($id);
        $employe = Employe::with('person','patient.person.image','surgery', 'schedule' )->where('person_id',$person->person_id)->first();
        // dd($employe);
        $all = Surgery::with('patient.person.image','typesurgeries','area')->where('employe_id', $employe->id)->get();

        //cirugias del dia
        $surgeryT=Surgery::with('patient.person.image','typesurgeries','area')->where('employe_id', $employe->id)->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();

        $reservations = Reservation::with('person', 'patient.image')->where('surgery', true)->where('person_id', $employe->person_id)->get();
        // dd($reservations->first()->person->employe->areaassigment);
        //procedimientos ambulatorios del dia
        $ambulatorias = Reservation::where('surgery', true)->where('person_id',$employe->person_id )->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->get();
      
        //============INICIO CONTADORES===========================
        //estas se usaran en caso de que se quiera en un rango semanal
        // $dia1 = Carbon::MONDAY;
        // $dia2 = Carbon::FRIDAY;
      
        $mes = Carbon::now()->format('m');
        $año = Carbon::now()->format('Y');
        $surgery1 = Surgery::where('employe_id', $employe->id)->whereMonth('created_at', '=', $mes)->get();
        $surgery2 = Surgery::where('employe_id', $employe->id)->whereYear('created_at', '=', $año)->get(); //todas del mismo año
        // cirugias semanal
        $mensual = $surgery1->intersect($surgery2)->count();  //arroja todas del mes y mismo año

        $ambulatorio1 = $reservations = Reservation::where('surgery', true)->where('person_id', $employe->person_id)->whereMonth('created_at', '=', $mes)->get();
        $ambulatorio2 = $reservations = Reservation::where('surgery', true)->where('person_id', $employe->person_id)->whereYear('created_at', '=', $año)->get();
        //procedimientos ambulatoriossemanales
        $procedimiento = $ambulatorio1->intersect($ambulatorio2)->count();
        //==============FIN CONTAODRES========================
        

        return view('dashboard.doctor.lista_cirugias', compact('all', 'surgeryT', 'mensual', 'ambulatorias', 'procedimiento', 'reservations'));
    }

    public function diagnosticDelete(){


            $diagnostic= Diagnostic::where('status', false)->get();
            $diagnostic->delete();
            // dd($d);
        }


    public function recipeDelete(Request $request){
        // dd($request);
        $recipe = Recipe::find($request->recipe_id);
        $treatment = Treatment::find($request->tratamiento_id);
        $recipe->treatment()->detach($treatment);
        $treatment->delete();

        $recipe= Recipe::with('treatment')->where('id', $request->recipe_id)->first();

        if(empty($recipe->treatment->first())){
            $itinerary = Itinerary::where('recipe_id', $recipe->id)->first();
            $itinerary->recipe_id = null;
            $itinerary->save();
            $recipe->delete();
        }

        return response()->json([
            'recipe' => 'Medicamento eliminado correctamente',202
        ]);
    }

    public function treatment_detalles(Request $request){
  
        $treatment = Treatment::with('medicine')->where('id',$request->treatment_id)->first();
// dd($treatment);
        return response()->json([
            'treatment' => $treatment,202
        ]);
    }

    public function treatment_update(Request $request){

        // dd($request);
        $medicine = Medicine::where('name', $request->medicina)->first();

        $treatment = Treatment::find($request->tratamiento);
        $treatment->medicine_id = $medicine->id;
        $treatment->doses = $request->dosis;
        $treatment->measure = $request->medida;
        $treatment->duration = $request->duracion;
        $treatment->indications = $request->indicaciones;
        $treatment->save();

        $treatment = Treatment::with('medicine')->where('id', $treatment->id)->first();

// dd($treatment);
        return response()->json([
            'treatment' => $treatment,202
        ]);
    }



    //========================anular consulta======================
    public function anular_consulta(Request $request){

        $diagnostic = Diagnostic::with('procedures','exam')->where('id',$request->id)->first();

        $itinerary = Itinerary::with('person.patient.inputoutput')->where('reservation_id', $diagnostic->reservation_id)->first();

        // dd($itinerary->person->patient->inputoutput->inside_office);

        $itinerary->person->inputoutput->inside=null;
        $itinerary->save();
      

        if($itinerary->procedureR_id != null){ //eliminar procedimientos realizados en consulta de itinerary y tabla pivote
            $itinerary->procedureR_id = null;
            $itinerary->save();
         
            foreach($diagnostic->procedures as $item){
                $item->diagnostic()->detach($diagnostic);
            }
        }

        if($itinerary->exam_id != null){   //eliminar examenes de itinerary y tabla pivote
            $itinerary->exam_id = null;
            $itinerary->save();
         
            foreach($diagnostic->exam as $item){
                $item->diagnostic()->detach($diagnostic);
            }
        }
    
        if($itinerary->recipe_id != null){ //eliminar recipe de itinerary y tabla pivote
            $recipe = Recipe::with('treatment')->where('id',$itinerary->recipe_id)->first();
         
            foreach($recipe->treatment as $item){
                $item->recipe()->detach($recipe);
            }
            $recipe->delete();
            $itinerary->recipe_id= null;
            $itinerary->save();
        }

        if($itinerary->reference_id != null){ //eliminar referencia
            $reference = Reference::find($itinerary->reference_id);
            $reference->delete();
            $itinerary->reference_id=null;
            $itinerary->save();
        }

        if($itinerary->report_medico_id != null){ //eliminar reporte medico 
            $reporte = ReportMedico::find($itinerary->report_medico_id);
            $reporte->delete();
            $itinerary->report_medico_id=null;
            $itinerary->save();
        }

        if($itinerary->repose_id != null){ //eliminar reposo de itinerary
            $repose = Reposo::find($itinerary->repose_id);
            $repose->delete();
            $itinerary->repose_id=null;
            $itinerary->save();
        }

        $itinerary->status='dentro';
        $itinerary->save();

        $diagnostic->delete();

    //     $employe = Employe::find($itinerary->employe_id);
    //     $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->with('patient.inputoutput')->where('person_id',$employe->person_id)->get();
    //    dd($day);

    //     $dia = strtolower(Carbon::now()->locale('en')->dayName); 
       
        //buscando pacientes que atenderan los medicos que atenderan citas hoy
//         $pacientes = array();
//         for($i=0; $i < count($medicos); $i++){
         
//             for($j=0; $j < count($day); $j++){
// // dd($day[$j]->patient->inputoutput->first());
//                 if($day[$j]->person_id ==  $medicos[$i]->person_id){
//                     $pacientes[$i][] = $day[$j]; 
//                 }
//             }   
//         }

        // && $day[$j]->patient->inputoutput->first()->outside_office == null

        // for($i=0; $i < count($pacientes); $i++){
        //     // dd($pacientes);
        //  $active =null;
        //     for($j=0; $j < count($pacientes[$i]); $j++){
        //         // dd($pacientes[$i][$j]->patient->inputoutput->first()->outside_office);
        //         if(!empty($pacientes[$i][$j]->patient->inputoutput->first())){
        //         if($pacientes[$i][$j]->patient->inputoutput->first()->outside_office == null){

        //             if( $active  == null){
        //                $active = $pacientes[$i][$j];
        //             }else{
        //                 if($active->patient->inputoutput->first()->created_at->format('H:i:s')  >  $pacientes[$i][$j]->patient->inputoutput->first()->created_at->format('H:i:s')){
        //                    $active = $pacientes[$i][$j];
        //              } 
                     
        //             } 
        //         }
        //     }
        //     }   

        //     if($active != null){
        //         $inputoutput = Inputoutput::find($active->patient->inputoutput->first()->id);
        //         $inputoutput->activo =true;
        //         $inputoutput->save();
        //     }
          
        // }

        return response()->json([
            'diagnostic' => 202
        ]);
     }

     public function redireccion(){

        Alert::success('Consulta anulado correctamente!');
        return redirect()->route('doctor.index');

     }


}

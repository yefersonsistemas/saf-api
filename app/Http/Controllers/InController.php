<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Employe;
Use App\Area;
Use App\Billing;
Use App\AreaAssigment;
use App\Disease;
use App\Http\Requests\CreateBillingRequest;
use App\Http\Requests\CreateAreaAssigmentRequest;
use App\Schedule;
use App\TypeArea;
use App\Person;
use App\InputOutput;
use App\Medicine;
use App\Reservation;
use App\Patient;
use App\Allergy;
use App\Cite;
use App\Doctor;
use App\Assistance;
use App\Itinerary;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Image;
//use App\Http\Controllers\CitaController;


class InController extends Controller
{
    /**
     * Muestra todas las listas
     * de pacientes
     *
     */

    //=============================Eliminar dropzone=========================
    public function prueba_eliminar(Request $request)
    {
        $datos=json_decode($request->filename);
        $id= $datos->data->id;
        $image = File::find($id);
        $image->delete();
        return $image;
    }


    public function index()
    {
        // $carbon = Carbon::now()->addDay(2)->format('Y-m-d');
        // dd($carbon);

        $reservations = Reservation::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date', 'asc')->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
        // dd($reservations);
        $aprobadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get();
        // dd($aprobadas);
        $canceladas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('cancel')->get();
        // dd($canceladas);
        $reprogramadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('reschedule')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNull('cancel')->get();
// dd($reprogramadas);
        $suspendidas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('discontinued')->get();
// dd($suspendidas);
        // dd($reservations);

        return view('dashboard.checkin.index', compact('reservations', 'aprobadas', 'canceladas', 'suspendidas', 'reprogramadas'));
    }

    //========================= Citas del dia (las que estan aprobadas) ======================
    public function day()
    {
        $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->with('person.inputoutput', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality', 'itinerary')->get();
        // dd($day);
        $employe = Employe::with('schedule', 'assistance')->get();

        // dd($employe);

        $medicos = array();
        $dia = strtolower(Carbon::now()->locale('en')->dayName);
        // dd($dia);

        //buscando medicos que atenderan citas hoy
        foreach($employe as $item){
            foreach($item->schedule as $em){
                if($em->day == $dia){
                    if(!empty($item->assistance->first())){
                        $medicos[] = $item;
                    }
                }
            }
        }
        // dd($medicos);

        //buscando pacientes que atenderan los medicos que atenderan citas hoy
        $pacientes = array();
        for($i=0; $i < count($medicos); $i++){

            for($j=0; $j < count($day); $j++){
// dd($day[$j]->patient->inputoutput->first());
                if($day[$j]->person_id ==  $medicos[$i]->person_id){
                    $pacientes[$i][] = $day[$j];
                }
            }
        }

        // && $day[$j]->patient->inputoutput->first()->outside_office == null

        for($i=0; $i < count($pacientes); $i++){
            // dd($pacientes);
         $active =null;
            for($j=0; $j < count($pacientes[$i]); $j++){
                // dd($pacientes[$i][$j]->patient->inputoutput->first()->outside_office);
                if(!empty($pacientes[$i][$j]->patient->inputoutput->first())){
                if($pacientes[$i][$j]->patient->inputoutput->first()->outside_office == null){

                    if( $active  == null){
                       $active = $pacientes[$i][$j];
                    }else{
                        if($active->patient->inputoutput->first()->created_at->format('H:i:s')  >  $pacientes[$i][$j]->patient->inputoutput->first()->created_at->format('H:i:s')){
                           $active = $pacientes[$i][$j];
                     }

                    }
                }
            }
            }

            if($active != null){
                $inputoutput = Inputoutput::find($active->patient->inputoutput->first()->id);
                $inputoutput->activo =true;
                $inputoutput->save();
            }

        }

        // dd($active);


        return view('dashboard.checkin.day', compact('day'));
    }

    public function record()
    {
        $record = Reservation::whereDate('date', '<', Carbon::now()->format('Y-m-d'))->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
        return view('dashboard.checkin.record-citas', compact('record'));
    }


    public function approved()
    {
        $approved = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get();
        return view('dashboard.checkin.approved', compact('approved'));
    }

    public function pending()
    {
        $hoy = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '=', Carbon::now()->format('Y-m-d'))->whereNull('approved')->whereNull('discontinued')->whereNull('cancel')->whereNull('reschedule')->get();
        $horas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '=', Carbon::now()->addDay(2)->format('Y-m-d'))->orderBy('date', 'asc')->whereNull('approved')->whereNull('discontinued')->whereNull('cancel')->whereNull('reschedule')->get();
        $todas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereNull('approved')->whereNull('discontinued')->whereNull('cancel')->whereNull('reschedule')->orderBy('date', 'asc')->get();
        // dd($pending);

        return view('dashboard.checkin.pending', compact('hoy', 'horas', 'todas'));

    }

    /**
     * Muestra las areas y medicos
     * disponibles en la vista
     * de asignar consultorio
     */
    public function create()
    {
        $type = TypeArea::where('name','Consultorio')->first(); // Trae los consultorio
        // dd($type_area);
        $areas = Area::with('image')->where('type_area_id',$type->id)->get(); // Trae la informacion de Consultorios
        // dd($areas);

        $employes = Employe::with('image','person.user', 'speciality', 'assistance','areaassigment')->get();
            // dd($employes);
        $em = collect([]);
        if ($employes->isNotEmpty()) {
            foreach ($employes as $employe) {
                if ($employe->person->user->role('doctor') && $employe->position->name == 'doctor') {
                    if ($employe->schedule->isNotEmpty()) {
                        $dia = strtolower(Carbon::now()->locale('en')->dayName); //Trae los medicos del dia
                        foreach ($employe->schedule as $schedule) {
                            if ($schedule->day == $dia) {
                                $em->push($employe);
                            }
                        }
                    }
                }
            }
        }

        // dd($em);
        return view('dashboard.checkin.create', compact('areas', 'em'));
    }

    /*
    * muestra los consultorios en la vista de asistencia del medico
    */
    public function consultorio()
    {
        $type = TypeArea::where('name','Consultorio')->first(); // Trae los consultorio
        // dd($type);

        // $areas = Area::with('image')->where('type_area_id',$type->id)->whereTime('created_at', '=', '15:07')->get(); // Trae la informacion de Consultorios

        //     foreach($areas as $item){
        //         $item->status = null;
        //         $item->update();

        //     }
        //limpia los campos  al cumplir la hora y al refrescar la pagina

        $areas = Area::with('image')->where('type_area_id',$type->id)->get(); //busca rodas las areas de tipo consultorio
        // dd($areas);
        $dia = strtolower(Carbon::now()->locale('en')->dayName);  //da el nombre del dia en ingles
        // dd($dia);

        return view('dashboard.checkin.show-area', compact('areas', 'dia'));
    }

    public function change($id)
    {
        $area = Area::with('areaassigment')->where('id', $id)->first();
        // dd($area);
        $asistencia = Assistance::create([
            'employe_id' =>  $area->areaassigment->employe_id,
            'status' => true,
            'branch_id' => 1,
        ]);

        $area->status = 'ocupado';
        $area->update();

        return redirect()->back();
    }

    /**
     *
     * busca la historia desde la lista de check-in
     *
     */
    public function search_history($id, $id2){
        $mostrar = $id2;

        $rs = Reservation::with('patient.historyPatient.medicine','patient.historyPatient.disease','patient.historyPatient.allergy','patient.image')->where('id', $id)
                        ->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->first();

        $cites = Reservation::with('patient.historyPatient','patient', 'speciality.employe.person')->whereNotIn('id', [$rs->id])->where('patient_id', $rs->patient_id)->get();

        $disease = Disease::all();
        $enfermedades = Disease::all();
        $medicine = Medicine::get();
        $medicinas = Medicine::all();
        $allergy = Allergy::get();
        $alergias = Allergy::all();

        $diff_medicine = $medicine->diff($rs->patient->historyPatient->medicine); //modal de medicinas

        return view('dashboard.checkin.history', compact('rs', 'cites', 'disease', 'medicine', 'allergy', 'mostrar','enfermedades','alergias','medicinas','diff_medicine'));
    }

     /**
     *
     * guarda registros nuevos y editados
     * en la historia del paciente
     *
     */

    public function guardar(Request $request, $id)  //REVISAR
     {
        //  dd($request);
        if($request->file('file')){
            $reservation = Reservation::find($id);

            $image = $request->file('file');
            $path = $image->store('public/exams');
            $path = str_replace('public/', '', $path);
            $image = new File;
            $image->path = $path;
            $image->fileable_type = "App\Person";
            $image->fileable_id = $reservation->patient_id;
            $image->branch_id = 1;
            $image->save();

            return response()->json(["status" => "success", "data" => $image]);
        }

        $person = Person::where('dni', $request->dni)->first();
        $reservation = Reservation::find($id);
        if (!is_null($person)) {

            if ($person->historyPatient == null) {
                $data = $request->validate([
                    'gender'        =>  'required',
                    'place'         =>  'required',
                    'birthdate'     =>  'required',
                    'weight'        =>  'required',
                    'occupation'    =>  'required',
                    'profession'    =>  'required',
                    'another_email' =>  'nullable',
                    'another_phone' =>  'nullable',
                    'social_network'=>  'nullable',
                    'about_us'      =>  'nullable',
                ]);

                $age = Carbon::create($data['birthdate'])->diffInYears(Carbon::now());

                $patient = Patient::create([
                    'history_number'=> $this->numberHistory(),
                    'another_phone' =>  $data['another_phone'],
                    'another_email' =>  $data['another_email'],
                    'social_network'=>  $data['social_network'],
                    'about_us'      =>  $data['about_us'],
                    'date'          =>  Carbon::now(),
                    'reason'        =>  $reservation->description,
                    'gender'        =>  $data['gender'],
                    'age'           =>  $age,
                    'person_id'     =>  $person->id,
                    'place'         =>  $data['place'],
                    'birthdate'     =>  Carbon::create($data['birthdate']),
                    'weight'        =>  $data['weight'],
                    'occupation'    =>  $data['occupation'],
                    'profession'    =>  $data['profession'],
                    'previous_surgery'  => $request->previous_surgery,
                    'employe_id'    =>  $reservation->person_id,
                    'branch_id'     =>  1,
                ]);
            }

            $patient = Patient::where('person_id', $person->id)->first();
            // dd($patient);
            if ($person->historyPatient != null) {

                $age = Carbon::create($request->birthdate)->diffInYears(Carbon::now());

                $patient->update([
                    'history_number'=> $this->numberHistory(),
                    'another_phone' =>  $request->another_phone,
                    'another_email' =>  $request->another_email,
                    'reason'        =>  $reservation->description,
                    'gender'        =>  $request->gender,
                    'age'           =>  $age,
                    'place'         =>  $request->place,
                    'birthdate'     =>  $request->birthdate,
                    'weight'        =>  $request->weight,
                    'occupation'    =>  $request->occupation,
                    'profession'    =>  $request->profession,
                    'previous_surgery'  => $request->previous_surgery,
                    'social_network'=>  $request->social_network,
                    'about_us'      =>  $request->about_us,
                ]);
            }

            $patients = Person::find($patient->person_id);

            // $data = $request->validate([
            //     'address' => 'nullable'
            // ]);

            // if($person->historyPatient != null) {

            //     $patients->update([
            //         'address'=> $data['address'],
            //     ]);
            // }

            if($request->address != null) {

                $patients->address = $request->address;
                $patients->save();
            }


            // dd($patient);
            if($request->foto != null){
                $image = $request->file('foto');
                $path = $image->store('public/Person');
                $path = str_replace('public/', '', $path);
                $image = new Image;
                $image->path = $path;
                $image->fileable_type = "App\Person";
                $image->fileable_id = $patient->id;
                $image->branch_id = 1;
                $image->save();
            }

            if ($request->file != null) {
                $photo = $request->file;

                foreach($photo as $file){
                    $image = $request->file('file');
                    // $path = $image->store('public/exams');
                    // $path = str_replace('public/', '', $path);
                    $image = new File;
                    // $image->path = $path;
                    $image->path = 'exam'.'\\'.$image;
                    $image->fileable_type = "App\Person";
                    $image->fileable_id = $person->id;
                    $image->branch_id = 1;
                    $image->save();
                }
            }

            if (!is_null($patient)) {
                if (!empty($request->disease)) {
                    foreach ($request->disease as $disease) {
                        $di = Disease::find($disease);
                        $patient->disease()->sync($request->disease);
                    }
                }


                if (!empty($request->medicine)){

                    foreach ($request->medicine as $medicine) {
                        $me = Medicine::find($medicine);
                        $patient->medicine()->attach($me);
                    }
                }

                if (!empty($request->allergy)){

                    foreach ($request->allergy as $allergy) {
                        $al = Allergy::find($allergy);
                        $patient->allergy()->attach($al);
                    }
                }

                Alert::success('Guardado exitosamente');
                return redirect()->route('checkin.day');
            }
        }
    }


    //======================== para indicar que el paciente entro a las instalacion ===============


    public function statusIn($id)
    {

        // dd($registro);
        // $busqueda =  Reservation::with('employe.person')->whereDate('date', Carbon::now()->format('Y-m-d'))->where('patient_id', $registro)->first();

        $busqueda = Reservation::with('person')->where('id',$id)->whereDate('date', Carbon::now()->format('Y-m-d'))->first();
        // dd($busqueda);

        $paciente = $busqueda->patient_id;
        $doctor = $busqueda->person_id; // en tabla person
        $employe = Employe::where('person_id', $doctor)->first();
        $doctos = Doctor::where('employe_id',$employe->id)->first();

        $itinerary = Itinerary::where('reservation_id', $id)->first();

        $p = Patient::where('person_id', $paciente)->first();

        $io = InputOutput::where('person_id', $p->person_id)->where('employe_id', $employe->id)->first();
        // dd($io);
        if ($io == null) {

            $inputOutput= InputOutput::create([
                'person_id' =>  $paciente,  //paciente tratado
                'inside' => 'dentro',
                'outside' => null,
                'employe_id' =>  $employe->id,  //medico asociado para cuando se quiera buscar todos los pacientes visto por el mismo medico
                'branch_id' => 1,
            ]);

            $itinerary->status ='dentro';
            $itinerary->save();

        }
        else{
            Alert::error('Paciente ya esta dentro');
            return redirect()->back();
        };

        Alert::success('Paciente dentro de las instalaciones');
        return redirect()->back();
    }

    //========================= dentro del consultorio =================
    public function insideOffice($id)
    {
        // dd($id);
        $reservation = Reservation::with('person')->where('id',$id)->whereDate('date', Carbon::now()->format('Y-m-d'))->first();
        // $busqueda =  Reservation::with('employe.person')->whereDate('date', Carbon::now()->format('Y-m-d'))->where('patient_id', $registro)->first();
        // dd($reservation);

        $paciente = $reservation->patient_id;
        $doctor = $reservation->person_id;

        $employe = Employe::where('person_id', $doctor)->first();
        // dd($employe);

        $io = InputOutput::where('person_id', $paciente)->where('employe_id', $employe->id)->first();
        $itinerary = Itinerary::where('reservation_id', $reservation->id)->first();
        $itinerary->status = 'dentro_office';
        $itinerary->save();

        if (empty($io->inside_office)) {
            $io->inside_office = 'dentro';
            $io->save();
            // dd($io);

        }else{
            Alert::error('no lo hizo');
            return redirect()->back();
        }

        Alert::success('Paciente dentro del consultorio');
        return redirect()->back();
    }


    public function status(Request $request)
    {
        $data = $request->validate([
            'reservation_id'    =>  'required',
            'type'              =>  'required',
            'motivo'            =>  'required',
        ]);

        $reservation = Reservation::where('id', $data['reservation_id'])->where('status', '!=', $data['type'])->first();

        if (!is_null($reservation)) {
            if($data['type'] == 'Suspendida'){
                $reservation->discontinued = Carbon::now();
                $cita = Cite::create([
                    'reservation_id'    =>  $data['reservation_id'],
                    'reason'            =>  $data['motivo'],
                    'branch_id'         => 1,
                ]);
                Alert::success('Cita suspendida exitosamente');

            }elseif ($data['type'] == 'Cancelada') {
                if ($reservation->discontinued != null) {
                    $reservation->discontinued = null;
                }elseif ($reservation->approved != null) {
                    $reservation->approved = null;
                }

                $cita = Cite::create([
                    'reservation_id'    =>  $data['reservation_id'],
                    'reason'            =>  $data['motivo'],
                    'branch_id'         => 1,
                ]);
                $reservation->cancel = Carbon::now();
                Alert::success('Cita Cancelada exitosamente');

            }elseif ($data['type'] == 'Aprobada') {
                $reservation->approved = Carbon::now();
                if ($reservation->discontinued != null) {
                    $reservation->discontinued = null;
                }

                Alert::success('Cita Aprobada exitosamente');
            }

            $reservation->status = $data['type'];
            $reservation->save();

            return redirect()->route('checkin.index');
        }else{
            Alert::error('No se puede '.$data['type'].' esta cita');
            return redirect()->back();
        }

    }


    public function numberHistory()
    {
        $patient    = Patient::all()->last();
        if ($patient == null) {
            $number = 1;
        } else {
            $number = $patient->id + 1;
        }

        if (strlen($number) == 1) {
            $history_number = 'P-000' . $number;
        } elseif (strlen($number) == 2) {
            $history_number = 'P-00' . $number;
        } elseif (strlen($number) == 3) {
            $history_number = 'P-0' . $number;
        } else {
            $history_number = 'P-' . $number;
        }
        return $history_number;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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


    public function destroy($id)
    {
        //
    }
/**
     * busca el area para la
     * asignacion del consultorio
     *
     */
    public static function search_area(Request $request)
    {
        // dd($request);
        $area = Area::Where('id', $request->id)->first();
        // dd($area);
        if ($area != null) {  //si existe
            $areas= $area->name;
            return response()->json([
                'areas' => $areas,
            ]);

        }else{  //caso de que no exista
            return response()->json([
                'message' => 'Consultorio no encontrado',
            ]);
        }
    }

/**
     * busca el medico que sera asignado
     * a un consultorio
     *
     */
    public static function search_medico(Request $request)
    {
        // dd($request);
        $employe = Employe::with('person')->Where('id', $request->id)->first();
        // dd($area);
        if ($employe != null) {  //si existe
            $employes= $employe->person->name;
            return response()->json([
                'employes' => $employes,
            ]);

        }else{  //caso de que no exista
            return response()->json([
                'message' => 'Medico no encontrado',
            ]);
        }
    }

    /**
     *
     * busca el horario que se muestra
     * en la lista de medico
     *
     */
    // public static function horario(Request $request){
    //     // dd($request);

    //     if(!empty($employe)){
    //         return response()->json([
    //             'employe' => $employe,201
    //         ]);
    //     }else{
    //         return response()->json([
    //             'employe' => 202
    //         ]);
    //     }
    // }

    /**
     *
     * guarda el consultorio
     * asignado al medico
     *
     */


    public static function assigment_area(Request $request) //asignacion de consultorio
    {
            // dd($request);
        $e = $request->employe_id;
        $a = $request->area_id;
// si los datos no estas vacios
    if($e != null && $a != null){

        $existe = AreaAssigment::where('employe_id',$e)->where('area_id', $a)->first();

        if(empty($existe)){
            $areaAssigment = AreaAssigment::create([
            'employe_id'  => $e,
            'area_id'     => $a,
            'branch_id' => 1,
            ]);

            // dd($areaAssigment);

            $act = Area::find($request->area_id);

            $act->status = 'ocupado';
            $act->save();
            // dd($act);

            return redirect()->route('checkin.index')->withSuccess('Consultorio Asignado');
            }
        }else{
            return redirect()->back()->withError('No Se Pudo Asignar');
        }
    }

    // public function update_area(Request $request)
    // {
    //     $a = Area::find($request->id);

    //     if (!empty($a)) {

    //         $a->status = 'ocupado';
    //         $a->save();

    //         // if ($a->save()){
    //         //    return response()->json([
    //         //         'message' => 'ocupado',
    //         //     ]);
    //         // }
    //     }
    // }


    public function exams_previos(Request $request)
    {
        // dd($request);
        if ($request->file != null) {

            $image = $request->file('file');
            $path = $image->store('public/exams');
            $path = str_replace('public/', '', $path);
            $image = new File;
            $image->path = $path;
            $image->fileable_type = "App\Patient";
            $image->fileable_id = $request->patient;
            $image->branch_id = 1;
            $image->save();
        }
    }

    public function guardar_foto(){

        $datos=json_decode(file_get_contents("php://input"));
        $imagenCodificada=$datos->pic;
        if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
        //Calcular un nombre único
        $nombreImagenGuardada = "foto_" . uniqid() . ".png";
        //Escribir el archivo
        file_put_contents(public_path("storage\\person\\".$nombreImagenGuardada), $imagenDecodificada);
        $path=("person/".$nombreImagenGuardada);

        // $newimg=Image::find($datos.idimage);
        // dd($newimg);
        //Terminar y regresar el nombre de la foto
            $image = Image::find($datos->idimage);
            $image->path = $path;

            // $image->imageable_type = "App\Person";
            // $image->imageable_id = $datos->idpatient;
            // $image->branch_id = 1;
            $image->save();
            $urlfoto=$image;
            // return response()->json([
            //     'foto' => $path,
            //     'Mensaje'=>'Imagen guardada correctamente'
            //     ]);
            // exit($nombreImagenGuardada);
        exit($path);
    }

    public function diseases(Request $request){ //Metodo para agregar enfermedades al paciente en el multiselect de editar historia

    // Aqui se realiza la relacion entre paciente y enfermeda, tambien se busca al paciente correspondiente a la historia
    $patient = Patient::with('disease')->where('person_id',$request->id)->first();

    // Aqui se realiza el recorrido las enfermedades del paciente que estan en la DB.
    if($patient->disease->first() != null)
    for ($i=0; $i < count($patient->disease); $i++) {
        $patientd[] = $patient->disease[$i]->id;
    }

    // Aqui se realiza el recorrido las enfermedades que se agregan al editar la historia.
    for ($i=0; $i < count($request->data); $i++) {
        $disease = Disease::find($request->data[$i]);
        $disease->patient()->sync($patient);
    }

    if ($patient->disease->first() != null) {
        $diff = array_diff($request->data,$patientd);
    } else {
        $diff = $request->data;
    }

    for ($i=0; $i < count($diff); $i++) {
        $diseases[] = Disease::find($diff);
    }

    // dd($disease);
    return response()->json([
        'data' => 'Enfermedad Agregada',$diseases,201
        ]);
    }

    public function allergies(Request $request){ //Metodo para agregar alergias al paciente en el multiselect de editar historia
        // Aqui se realiza la relacion entre paciente y alergias, tambien se busca al paciente correspondiente a la historia
        $patient = Patient::with('allergy')->where('person_id', $request->id)->first();
        // Aqui se realiza el recorrido las enfermedades del paciente que estan en la DB.
        if($patient->allergy->first() != null) {
            for ($i=0; $i < count($patient->allergy); $i++) {
                $patienta[] = $patient->allergy[$i]->id;
            }
        }
        // Aqui se realiza el recorrido las enfermedades que se agregan al editar la historia.
        for ($i=0; $i < count($request->data); $i++) {
            $allergy = Allergy::find($request->data[$i]);
            $allergy->patient()->sync($patient);
        }

        if ($patient->allergy->first() != null ) {
            $diff= array_diff($request->data, $patienta);
        } else {
            $diff = $request->data;
        }

        for ($i=0; $i < count($diff); $i++) {

            $allergies[] = Allergy::find($diff);
        }
        // dd($allergies[0][0]->name);
        return response()->json([
            'data' => 'Alergia Agregada',$allergies,201
            ]);
    }

    public function medicines(Request $request){ //Metodo para agregar medicina al paciente en el multiselect de editar historia

        $returndata2 = array();
        $strArray = explode('&', $request->data);

        foreach($strArray as $item) {
            $array = explode("=", $item);
            $returndata[] = $array;
        }

        for($i=0; $i < count($returndata); $i++){
            for($y=1; $y <= 1; $y++){
            $returndata2[$i] = $returndata[$i][$y];
            }
        }

        $reservation = Reservation::find($request->id);
        $patient = Patient::with('medicine')->where('person_id', $reservation->patient->id)->first();

        for ($i=0; $i < count($returndata2); $i++) {
            $medicine[] = Medicine::find($returndata2[$i]);
            $medicine[$i]->patient()->sync($patient);
        }
        for ($i=0; $i < count($patient->medicine); $i++) {
            $me[] = $patient->medicine;
        }

        if ($patient->medicine->first() != null ) {
            $medicines= array_diff($medicine, $me);
        } else {
            $medicines = $medicine;
        }
        return response()->json([
            'data' => 'Medicamento Agregado Exitosamente',$medicines,201
            ]);
    }



    public function allergies_create(Request $request){ //Metodo para crear alergia si no existe en el multiselect de editar historia
        //buscar paciente
        $patient = Patient::where('person_id', $request->id)->first();

        $data = $request->validate([
            'name' => 'required',
            ]);

        // dd($data);

        $allergy = Allergy::create([
            'name' => $data['name'],
            'branch_id' => 1
            ]);
        // dd($allergy);
        // guardar en tabla pivote con el registro de paciente y enfermedad

        $allergy->patient()->attach($patient);
        // dd($allergy);
        // Enviar el registro de enfermedad
        return response()->json([
            'data' => 'Alergia Agregada',$allergy,201
            ]);
    }

    public function medicines_create(Request $request){ //Metodo para crear medicina si no existe en el multiselect de editar historia

        //buscar paciente
        $patient = Patient::where('person_id', $request->id)->first();

        $data = $request->validate([
            'name' => 'required',
            ]);

        // dd($data);

        $medicine = Medicine::create([
            'name' => $data['name'],
            'branch_id' => 1
            ]);
        // dd($medicine);
        // guardar en tabla pivote con el registro de paciente y enfermedad

        $medicine->patient()->attach($patient);
        // dd($medicine);
        // Enviar el registro de enfermedad
        return response()->json([
            'data' => 'Medicamento Agregado',$medicine,201
            ]);
    }


    //======================eliminar medicamento========================
    public function medicine_borrar(Request $request){
        $reservation = Reservation::find($request->reservacion_id);
        $medicine = Medicine::find($request->id);
        $patient = Patient::where('person_id',$reservation->patient_id)->first();

        $medicine->patient()->detach($patient);

        return response()->json([
            'medicina' => 'Medicina eliminada correctamente',202,$medicine
        ]);
    }


}


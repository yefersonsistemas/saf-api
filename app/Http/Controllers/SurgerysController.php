<?php

namespace App\Http\Controllers;

use App\Cite;
use App\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Reservation;
use Illuminate\Http\Request;
Use App\Speciality;
Use App\Employe;
Use App\Schedule;
use App\Person;
use App\User;
use App\Patient;
use App\Surgery;
use App\Typesurgery;
use App\Itinerary;
use App\Doctor;
use App\Area;
use App\ClassificationSurgery;
use App\Procedure;
use App\Reservationsurgery;
use App\TypeArea;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class SurgerysController extends Controller
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
    // para agendar cirugia cuando el paciente se encuentra en el itinerario 
    public function create($id){
        // dd($id);
        $tipo = TypeArea::where('name', 'Quirofano')->first();

        $quirofano = Area::with('typearea','image')->where('type_area_id', $tipo->id)->get();     
        //aqui trae los datos asociados al parametro(cuando el paciente agenda el dia que fue candidato a cirugia)
        $paciente = Itinerary::with('person','typesurgery')->where('id',$id)->first();
        // dd($paciente);

        $itinerary = Itinerary::find($paciente->id);
        $medico = Typesurgery::with('employe_surgery.person.image')->where('id', $paciente->typesurgery->id)->first();

        // dd($medico);
        return view('dashboard.checkout.programar_cirugia', compact('quirofano', 'paciente', 'medico', 'itinerary'));
    }

    // para agendar cirugia cuando el paciente no se encuentra en el itinerario
    public function create_surgery(){

        $clasificacion = ClassificationSurgery::where('name', 'hospitalaria')->first();
        $surgeries = Typesurgery::with('classification')->where('classification_surgery_id',  $clasificacion->id)->get();
        // dd( $surgeries);
        $tipo = TypeArea::where('name', 'Quirofano')->first();
        $quirofano = Area::with('image')->where('type_area_id', $tipo->id)->get();     

        return view('dashboard.checkout.programar-cirugia', compact('surgeries', 'quirofano', 'cirugias' ));
    }

    
    //buscar paciente
    public function search_patients_out(Request $request){

        // dd($request);
        $person = Person::with('image')->where('type_dni', $request->type_dni)->where('dni', $request->dni)->first();
        // dd($person);
        
        if (!is_null($person)) {
            $patient = Patient::with('person')->where('person_id', $person->id)->first();
            // dd($patient);
        
            if (!is_null($patient)) {
                // $patient = Patient::with('person')->where('person_id', $person->id)->first();
                return response()->json([
                'patient' => $patient, 201
                ]);
            }else{
                return response()->json([
                    'message' => 'No encontrado',202
                ]);
            }
        }else{
            return response()->json([
                'message' => 'Persona no registrada',202
            ]);
        }
    }

    public function buscar_doctor(Request $request)
    {
        $employe = Employe::with('image','person.user', 'speciality', 'schedule', 'areaassigment')->where('id', $request->id)->first();
        // dd($employe);
        if (!is_null($employe)) {
        
            return response()->json([
                'medico' => $employe, 201
                ]);
        }else{
            return response()->json([
                'message' => 'No encontrado',202
            ]);
        }
    }

    
    public function create_ambulatoria($id){  //agendada el mimo dia por lo que pasa el id del paciente

        $paciente = Itinerary::with('person','employe.person')->where('id',$id)->first();
        // dd($paciente);

        $itinerary = Itinerary::find( $paciente->id);
      

        $employes = Employe::with('image','person.user', 'speciality', 'schedule', 'areaassigment')->get();
        // dd($employes);
        $em = collect([]);
        if ($employes->isNotEmpty()) {
            foreach ($employes as $employe) {
                if ($employe->person->user->role('doctor') && $employe->position->name == 'doctor') {
                    $em->push($employe);
                }
            }
        }

        $procedures = Procedure::get();

        return view('dashboard.checkout.ambulatoria-mismo-dia', compact('paciente', 'em', 'procedures', 'itinerary'));
    }

    public function create_surgery_ambulatoria(){

        $procedures = Procedure::get();
        // dd( $surgeries);  

        $employes = Employe::with('image','person.user', 'speciality', 'schedule', 'areaassigment')->get();
                // dd($employes);
            $em = collect([]);
            if ($employes->isNotEmpty()) {
                foreach ($employes as $employe) {
                    if ($employe->person->user->role('doctor') && $employe->position->name == 'doctor') {
                        $em->push($employe);
                    }
                }
            }
            // dd($em);

        return view('dashboard.checkout.agendar-cirugia-ambulatoria', compact('procedures', 'em'));
    }

    public function ambulatoria_store(Request $request)
    {
        // dd($request); 
        
        $patient = Patient::where('id', $request->patient_id)->first();  // paciente 1
        // dd($patient);

        if($patient != null){

            $diaDeReserva = strtolower(Carbon::create($request->date)->locale('en')->dayName); // se crea el dia jueves seleccionado
            // dd( $diaDeReserva);

            $schedule = Schedule::where('employe_id', $request->employe)->where('day', $diaDeReserva)->first(); // doctor 1 con horario dia jueves
            // dd($schedule);

            $date = Carbon::create($request->date);  //se crea la fecha seleccionada
            // dd($date);

            $employe = Employe::with('person', 'speciality')->find($request['employe']);
            $employe->load('schedule');
            // dd( $employe->speciality->first());
            // $fecha = Carbon::parse($request['date'])->locale('en');
            // dd($fecha);

            $date = Carbon::parse($request['date'])->Format('Y-m-d'); 
            // dd($date);
            // $diaDeReserva = strtolower($fecha->dayName);
            // dd($diaDeReserva);
            $dia = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
            // dd($dia);
            $cupos = $dia->quota; //obtengo el valor de quota
            // dd($cupos);
            $rs = Reservation::whereDate('date', $date)->get()->count(); //obtengo todos los registros de ese dia y los cuento
            // dd($rs);
            if ($employe->person->user->hasRole('doctor')) {  //el empleado debe ser doctor por rol y ocupacion sino no crea

                if ($rs <  $cupos) {

                    $paciente= Person::where('id', $patient->person_id)->first();
                    // dd($patient);
                    $medico = Person::where('id', $employe->person_id)->first();
                    // dd($medico);

                    $reservation = Reservation::create([
                        'date' => $date,
                        'description' => 'Procedimiento ambulatorio',
                        'patient_id' => $paciente->id,
                        'person_id' => $medico->id,
                        'schedule_id' => $dia->id,
                        'specialitie_id' => $request->speciality_id,
                        'status' => 'Pendiente',
                        'branch_id' => 1,
                    ]);

                    // dd($reservation);

                    $actualizar= Reservation::find($reservation->id);
                    $actualizar->surgery = true;
                    $actualizar->save();
                    // dd($actualizar);
                    
                    $itinerary =Itinerary::find($request->itinerary_id);
                    $itinerary->ambulatoria = $reservation->id;
                    $itinerary->save();
                    // dd($itinerary);
                }

                 
                if (!is_null($reservation)) {
                    if (!empty($request->procedure)) {
                        foreach ($request->procedure as $procedure) {
                            $procedimiento = Procedure::find($procedure);
                            $patient->procedure()->attach($procedimiento); 
                        }
                    }
                }

               


                return redirect()->route('checkout.index')->withSuccess('Cirugia Agendada Exitosamente!');
                

            }else{
                return response()->json([
                    'message' => 'No hay cupos',
                ]);
            }
        }
    }
    

    public function search_doctor(Request $request){    //medicos asociado a una cirugia
        
        $surgery = Typesurgery::with('employe_surgery.person', 'employe_surgery.image','employe_surgery.person.image')->where('id', $request->id)->first();
        // dd($surgery);
        if (!is_null($surgery)) {

            return response()->json([
                'surgery' => $surgery,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //agenda la cirugia cuando es el mismo dia de la propuesta
    public function store(Request $request)
    {   
        // dd($request);
        //datos a guardar en la tabla surgeries
        $p = Patient::with('person')->where('id', $request->patient_id)->first(); //tabla trayendo id del paciente
        $ts = $request->type_surgery_id;
        $e = $request->employe_id;
        $a = $request->area_id;
        $d = Carbon::create($request->date)->format('Y-m-d');

        if($p !=null && $ts !=null && $e !=null && $a !=null && $d !=null){
            
            $surgery = Surgery::create([		
                'patient_id' => $p->id,
                'type_surgery_id' => $ts,
                'employe_id' => $e,
                'area_id' => $a,
                'date'=> $d,
                'branch_id' => 1,
                ]);
                // dd($surgery);

                $itinerary =Itinerary::find($request->itinerary_id);
                $itinerary->hospitalaria = $surgery->id;
                $itinerary->save();

                //Actualiza el status del quirofano a ocupado
                $a = Area::find($request->area_id);
                
                if (!empty($a)) {
                    
                    $a->status = 'ocupado';
                    $a->save();
                }
                //actualizando el campo opertion de la tabla reservation
                $operation = Reservation::find($request->reservation_id);
                $operation->operation = true;
                $operation->save();

                //Relacion de paciente con la cirugia
                $surgery->patient()->attach($p);

                //llena los campos de la tabla Reservation_Surgery
                $relation = Reservationsurgery::create([
                    'reservation_id' => $request->reservation_id,
                    'surgery_id' => $surgery->id,
                    'branch_id' => 1
                ]);
            return redirect()->route('checkout.index')->withSuccess('Cirugia Agendada Exitosamente!');

        }else{
            return redirect()->back()->withError('Cirugia no Agendada, Verifique los Datos!');
        }

    }

    public function hospitalaria_store(Request $request)
    {   
        // dd($request);
        //datos a guardar en la tabla surgeries
        $p = Patient::with('person')->where('id', $request->patient_id)->first(); //tabla trayendo id del paciente
        $ts = $request->type_surgery_id;
        $e = $request->employe_id;
        $a = $request->area_id;
        $d = Carbon::create($request->date)->format('Y-m-d');

        if($p !=null && $ts !=null && $e !=null && $a !=null && $d !=null){
            
            $surgery = Surgery::create([		
                'patient_id' => $p->id,
                'type_surgery_id' => $ts,
                'employe_id' => $e,
                'area_id' => $a,
                'date'=> $d,
                'branch_id' => 1,
                ]);
                // dd($surgery);
                //Actualiza el status del quirofano a ocupado
                $a = Area::find($request->area_id);
                
                if (!empty($a)) {
                    
                    $a->status = 'ocupado';
                    $a->save();
                }
                // //actualizando el campo opertion de la tabla reservation
                // $operation = Reservation::find($request->reservation_id);
                // $operation->operation = true;
                // $operation->save();

                //Relacion de paciente con la cirugia
                $surgery->patient()->attach($p);

                //llena los campos de la tabla Reservation_Surgery
                // $relation = Reservationsurgery::create([
                //     'reservation_id' => $request->reservation_id,
                //     'surgery_id' => $surgery->id,
                //     'branch_id' => 1
                // ]);
            return redirect()->route('checkout.index')->withSuccess('Cirugia Agendada Exitosamente!');

        }else{
            return redirect()->back()->withError('Cirugia no Agendada, Verifique los Datos!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
    
}

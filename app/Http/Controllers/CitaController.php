<?php

namespace App\Http\Controllers;

use App\Cite;
use App\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateCiteRequest;
use Illuminate\Http\Request;
use App\Reservation;
Use App\Speciality;
Use App\Employe;
Use App\Schedule;
use App\Person;
use App\User;
use App\Patient;
use App\Surgery;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class CitaController extends Controller
{

    public function __invoke()
    {
        $reservations = Reservation::with('cite')->where('discontinued','!=', null)->get();
        if ($reservations->isNotEmpty()) {
            $reservations->each(function ($reservation)
            {
                if (!is_null($reservation->cite)) {
                    $tiempo = Configuration::where('name','limit')->first();
                    if ($tiempo->value != 'indefinido') {
                        $fechaLimite = Carbon::now()->subMonths(int($tiempo->value));
                        $created_at = Carbon::parse($reservation->cite->created_at);
                        if($created_at->lessThan($fechaLimite)){
                            $reservation->delete();
                        }
                    }
                }
            });
        }
    }

    public function index()
    {
        $reservations = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->get();

        $aprobadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get(); 

        $canceladas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('cancel')->get(); 

        $reprogramadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('reschedule')->get(); 

        $suspendidas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('discontinued')->get();

        $pendientes = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereNull('discontinued')->whereNull('reschedule')->whereNull('cancel')->whereNull('approved')->whereNotNull('status')->where('status', 'Pendiente')->get();

        return view('dashboard.reception.index', compact('reservations', 'aprobadas', 'canceladas', 'suspendidas', 'reprogramadas', 'pendientes'));
    }

    public function create()
    {
        $specialities = Speciality::all();
        return view('dashboard.reception.create', compact('specialities'));
    }

    public function search_patient(Request $request){

        $person = Person::where('type_dni', $request->type_dni)->where('dni', $request->dni)->first();

        if (!is_null($person)) {
            return response()->json([
                'person' => $person,201
            ]);
        }else{
            return response()->json([
                'message' => 'No encontrado',202
            ]);
        }
    }

    public function store(CreateReservationRequest $request)
    {

        if ($request->person == 'nuevo') {
            $person = Person::create([
                'type_dni'  => $request->type_dni,
                'dni'       => $request->dni,
                'name'      => $request->name,
                'lastname'  => $request->lastname,
                'address'   => $request->address,
                'phone'     => $request->phone,
                'email'     => $request->email,
                'status'    => 'Pendiente',
                'branch_id' => 1
            ]);

            $request->person = $person->id;
        }
        $dia = strtolower(Carbon::create($request->date)->locale('en')->dayName);

        $schedule = Schedule::where('employe_id',$request->doctor)->where('day', $dia)->first();

        $date = Carbon::create($request->date);

        $reservation = Reservation::create([		
            'date' => $date,
            'description' => $request->motivo,
            'patient_id' => $request->person,
            'person_id' => $request->doctor,
            'schedule_id' => $schedule->id,
            'status'      => 'Pendiente',
            'specialitie_id' => $request->speciality,
            'branch_id' => 1,
        ]);

        return $reservation;

        $employe = Employe::find($request['doctor_id']);
        $employe->load('schedule'); 
        $fecha = Carbon::parse($request['date'])->locale('en'); 
        //dd($fecha);

        $date = Carbon::parse($request['date'])->Format('Y-m-d'); 
        //dd($date);
        $diaDeReserva = strtolower($fecha->dayName);
        //dd($diaDeReserva);
        $dia = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
        //dd($dia);                  
        $cupos = $dia->quota; //obtengo el valor de quota 
       // dd($cupos);  
        $dia = Reservation::whereDate('date', $date)->get()->count(); //obtengo todos los registros de ese dia y los cuento
       // dd($dia);                                
        if ($employe->person->user->hasRole('doctor')) {  //el empleado debe ser doctor por rol y ocupacion sino no crea

            if ($dia <  $cupos) {

                $patient= Person::where('id', $request['id'])->first();
                //dd($patient);
                //dd($patient->id);

                $reservation = Reservation::create([		
                    'date' => $request['date'],
                    'description' => $request['description'],
                    'patient_id' => $request['patient_id'],
                    'person_id' => $request['person_id'],
                    'schedule_id' => $request['schedule_id'],
                    'specialitie_id' => $request['specialitie_id'],
                    'branch_id' => 1,
                ]);
            }
            return response()->json([
                'message' => 'Cita creada',
            ]);

        }else{
            return response()->json([
                'message' => 'No hay cupos',
            ]);
        }
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

            return redirect()->back();
        }else{
            Alert::error('No se puede '.$data['type'].' esta cita');
            return redirect()->back();
        }

    }

    public function edit($id)
    {
        $reservation = Reservation::with('patient','person','speciality')->find($id);
        // dd($reservation);
        
        if (!is_null($reservation)) {
            $specialities = Speciality::with('employe.person')->get();
            // dd($specialities);
            return view('dashboard.reception.edit', compact('reservation','specialities'));
        }else{
            Alert::error('Cita no encontrada!');
            return redirect()->back()->withErrors('Cita no encontrada');
        }
    }

    public function update(Reservation $cite, Request $request)
    {
        if (!is_null($cite)) {
            if ($request->dni != null) {
                $paciente = Person::where('id', $cite->patient_id)->first();
                if (!is_null($paciente)) {
                    $paciente->update([
                        'type_dni'  => $request->type_dni,
                        'dni'       => $request->dni,
                        'name'      => $request->name,
                        'lastname'  => $request->lastname,
                        'email'     => $request->email,
                        'address'   => $request->address,
                        'phone'     => $request->phone,
                    ]);
                }
            }
            if ($request->speciality != null) {
                $cite->specialitie_id = $request->speciality;
                // $employe = Employe::where('person_id', $request->doctor)->first();
                $cite->person_id  = $request->person_id;
                $cite->save();
            }
            // if ($request->fecha != null) {
            //     $dia = strtolower(Carbon::create($request->fecha)->locale('en')->dayName);
            //     // dd($cite->person->employe);
            //     $schedule = Schedule::where('employe_id', $cite->person->employe->id)->where('day', $dia)->first();
            //     $cite->date       = Carbon::create($request->fecha);
            //     $cite->reschedule = Carbon::now();
            //     $cite->schedule_id = $schedule->id;
            // }
            $cite->save();
            Cite::create([
                'reservation_id'    =>  $cite->id,
                'reason'            =>  $request->reason,
                'branch_id'         =>  1,
            ]);
            Alert::success('Cita actualizada exitosamente');
            return redirect()->route('checkin.index');
        }
    }

    public function createHistory($id)
    {
        $reservation = Reservation::with('patient','person')->where('id',$id)->first();
        // dd($reservation);
        // $person = Person::find($id);
        $fecha = Carbon::now()->format('Y-m-d');
        return view('dashboard.reception.history', compact('reservation','fecha'));
    }

    public function storeHistory($id, Request $request)
    {
        $reservation = Reservation::with('person','patient')->where('id',$id)->first();
        $data = $request->validate([
            'date'          =>  'required',
            'reason'        =>  'required',
            'gender'        =>  'required',
            'place'         =>  'required',
            'birthdate'     =>  'required',
            'weight'        =>  'required',
            'occupation'    =>  'required',
            'profession'    =>  'required',
            'email2'        =>  'nullable',
            'phone2'        =>  'nullable'
        ]);

        $age = Carbon::create($data['birthdate'])->diffInYears(Carbon::now());

        $patient = Patient::create([
            'history_number' => $this->numberHistory(),
            'another_phone' =>  $data['phone2'],
            'another_email' =>  $data['email2'],
            'date'          =>  Carbon::create($data['date']),
            'reason'        =>  $data['reason'],
            'gender'        =>  $data['gender'],
            'age'           =>  $age,
            'person_id'     =>  $reservation->patient->id,
            'place'         =>  $data['place'],
            'birthdate'     =>  Carbon::create($data['birthdate']),
            'weight'        =>  $data['weight'],
            'occupation'    =>  $data['occupation'],
            'profession'    =>  $data['profession'],
            'employe_id'    =>  $reservation->person->id,
            'branch_id'     =>  1,
        ]);

        if (!is_null($patient)) {
            Alert::success('Historia medica creada exitosamente. Su número de historia es: ' . $patient->history_number);
            return redirect()->route('citas.index');
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

    public function only_id(Request $request){  //id q recibe update_cite para poder reprogramar
        $reservation = Reservation::with('speciality', 'person', 'schedule', 'patient')->where('id', $request->id)->first();
        //dd($reservation);

        if (!empty($reservation)) {

            return response()->json([
                'all' =>  $reservation,
            ]);
        }
    }

    public function update_cite(UpdateCiteRequest $request){

        $reservation = Reservation::find($request->id);

        if (is_null($reservation)) {
            return response()->json([
                'message' => 'Cita invalida',
                'reservation' => $reservation,
                'request'   => $request,
            ]);
        }

        // return response()->json([
        //     'message' => $reservation->schedule->employe,
        // ]);
       
        $employe = $reservation->schedule->employe;  
        // $employe->load('schedule');

        $date = Carbon::parse($request['date'])->Format('Y-m-d');

        // return response()->json([
        //     'date' => $date,
        //     'carbon' => $request['date'],
        // ]);

        // return dd(Carbon::parse('2018-06-15 17:34:15.984512', 'UTC')->format('Y-m-d')->dayName);

        $diaDeReserva = strtolower(Carbon::parse($request['date'])->locale('en')->dayName); 
        //dd($diaDeReserva);

        $schedule = Schedule::where('employe_id', $employe->id)->where('day', $diaDeReserva)->first();
        // dd($schedule);
        
        if ($schedule == null) {
            return response()->json([
                'message' => 'El doctor no cuenta con ese horario',
                ]);
        }
                                 
        $cupos = $schedule->quota; 

        $dia = Reservation::whereDate('date', $date)->get()->count();
        
        if ($dia <  $cupos) {

            $reservation->date = $request->date;
            $reservation->description = $request->description;
            $reservation->patient_id = $request->patient_id;
            $reservation->person_id = $request->person_id;
            $reservation->schedule_id = $request->schedule_id;
            $reservation->specialitie_id = $request->specialitie_id;
            $reservation->reschedule = 'Reprogramado';

            if($reservation->save()){
                return response()->json([
                    'message' => 'Cambio de cita satisfactorio',
                ]);
            }else{
                return response()->json([
                    'message' => 'No se pudo actualizar la fecha',
                ]);
            }
        }else{
            return response()->json([
                'message' => 'No hay cupos disponibles para la fecha',
            ]);
        }
    }

    public function delete_cite($id){
        $reservation = Reservation::find($id);

        if(!is_null($reservation)){
           $reservation->delete();
 
                return response()->json([
                'message' => 'Cita eliminada',
                ]);
            }
    }

    public function speciality()
    {
       $speciality = Speciality::with('image')->get();
       //$speciality = Speciality::all();

        return response()->json([
            'speciality' => $speciality,
        ]);
    }


    public function search_doctor(Request $request){    //medico asociado a una especialidad 
        $speciality = Speciality::with('employe.person', 'employe.image')->where('id', $request->id)->get();

        if (!is_null($speciality)) {

            return response()->json([
                'speciality' => $speciality,
            ]);
        }
    }

}

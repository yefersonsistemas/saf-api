<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Employe;
Use App\Area;
Use App\Billing;
Use App\AreaAssigment;
use App\Disease;
use Carbon\Carbon;
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
use RealRashid\SweetAlert\Facades\Alert;

//use App\Http\Controllers\CitaController;


class InController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::whereDate('date', Carbon::now()->format('Y-m-d'))->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
        
        // dd($reservations);
        $aprobadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get(); 
        
        $canceladas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('cancel')->get(); 
        
        $reprogramadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('reschedule')->get(); 

        $suspendidas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('discontinued')->get();
       
        // dd($reservations->first()->patient->inputoutput->first());
        return view('dashboard.checkin.index', compact('reservations', 'aprobadas', 'canceladas', 'suspendidas', 'reprogramadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::with('typearea', 'image')->get();
        //dd($areas);
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
        }
       return view('dashboard.checkin.create', compact('areas', 'em'));
    }

    public function search_history(Request $request){  //busca historia para la lista de in
        $rs = Reservation::with('patient.historyPatient')->where('patient_id', $request->patient_id)
                         ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();

        $cites = Reservation::with('patient.historyPatient','speciality.employe.person')->where('patient_id', $request->patient_id)->get();
        //dd($cites);

        $disease = Disease::get();
       
        $medicine = Medicine::get();
        $allergy = Allergy::get();

        return view('dashboard.checkin.history', compact('rs', 'cites', 'disease', 'medicine', 'allergy'));
    }

    public function guardar(Request $request)
    {
        //dd($request);
        $person = Person::where('dni', $request->dni)->first();
        //dd($person);
         $patient = Patient::where('person_id', $person->id)->first();
         //dd($patient);


          if (!is_null($patient)) {
          
                $patient->update([
                    'age'               => $request->age,
                    'weight'            => $request->weight,
                    'occupation'        => $request->occupation,
                    'profession'        => $request->profession,
                    'another_phone'     => $request->another_phone,
                    'another_email'     => $request->another_email,
                    'previous_surgery'  => $request->previous_surgery,
                ]);

            Alert::success('Guardado exitosamente');
            return redirect()->route('checkin.index');
        }


        
    }

    public function statusIn($registro)
    {
        $busqueda =  Reservation::with('employe.person')->whereDate('date', Carbon::now()->format('Y-m-d'))->where('patient_id', $registro)->first();
        // dd($busqueda);
        $paciente = $busqueda->patient_id;
        $doctor = $busqueda->person_id;

        $p = Patient::where('person_id', $paciente)->first();
            // dd($p);
        $io = InputOutput::where('person_id', $p->person_id)->where('employe_id', $doctor)->first();
          
        if (empty($io->inside)) {
            InputOutput::create([       
                'person_id' =>  $paciente,  //paciente tratado
                'inside' => 'dentro',
                'outside' => null,
                'employe_id' =>  $doctor,  //medico asociado para cuando se quiera buscar todos los pacientes visto por el mismo medico
                'branch_id' => 1,
            ]);
        }
        else{
            Alert::error('Paciente ya esta dentro');
            return redirect()->back();
         };

          $reservation = Reservation::whereDate('date', Carbon::now()->format('Y-m-d'))->with('patient.inputoutput')->first();
        //  dd($reservation->patient->inputoutput);
     
        Alert::success('Paciente dentro');
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

 

    public static function assigment_area(Request $request) //asignacion de consultorio
    {
        $e = $request->employe_id;
        $a = $request->area_id;

       $existe = AreaAssigment::where('employe_id',$e)->where('area_id', $a)->first();

       if(empty($existe)){
        $areaAssigment = AreaAssigment::create([
        'employe_id'  => $e,
        'area_id'     => $a,
        'branch_id' => 1,
        ]);

        return response()->json([
            'asignado' => $areaAssigment,201
        ]);
         }else{
            return response()->json([
                'asignado' => 'Consultorio ya asignado',202
            ]);
         }
       
    }

    public function update_area(Request $request)
    {
        $a = Area::find($request->id);

        if (!empty($a)) {
          
            $a->status = 'ocupado';
            $a->save();

            // if ($a->save()){
            //    return response()->json([
            //         'message' => 'ocupado', 
            //     ]);
            // }
        }
    }


    public function exams_previos(Request $request)
    {
        $p = Patient::where('id', $request->id)->first();

        File::create([
            'filiable_type' => 'Paciente',
            'filiable_id' => $p->id,

        ]);

        $request->file('nombre del archivo')->store('Exams');
    }
}

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
        $reservations = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();
        
        // dd($reservations);
        $aprobadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get(); 
        
        $canceladas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('cancel')->get(); 
        
        $reprogramadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('reschedule')->get(); 

        $suspendidas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('discontinued')->get();
       // $pendientes = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNull('discontinued')->whereNull('reschedule')->whereNull('cancel')->whereNull('approved')->whereNotNull('status')->where('status', 'Pendiente')->get();

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
        //dd($em);

       return view('dashboard.checkin.create', compact('areas', 'em'));
    }

    //nombre doctor especilaidad fecha de reservacion y razon de la misma

    public function search_history(Request $request){  //busca historia para la lista de in
        $rs = Reservation::with('patient.historyPatient')->where('patient_id', $request->patient_id)
                         ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();

        $cites = Reservation::with('patient.historyPatient','speciality.employe.person')->where('patient_id', $request->patient_id)->get();
        //dd($cites);

        $disease = Disease::get();

        $medicine = Medicine::get();

        return view('dashboard.checkin.history', compact('rs', 'cites', 'disease', 'medicine'));
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
            return "ya registrado";
         };
        return "listo";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->validated();
        // $employe = Employe::create($data);
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

    public static function search(Request $request)
    {
       $area = Area::Where('id', $request->id)->first(); 

        if ($area != null) {  //si existe
            return response()->json([
                'message' => 'Consultorio ocupado',
            ]);
            
        }else{  //caso de que no exista
            return response()->json([
                'message' => 'Consultorio no encontrado',
            ]);
        }
    }

    // public function search_area(){//se tiene q modificar a id en vez de name o se muestra toda la tabla
    //     $types = TypeArea::with('areas.image')->where('name', 'Consultorio')->get();
    //     //dd($types);

    //    return view('dashboard.checkin.create', compact('types'));
    // }
        
    //hacer metodo que muestre solo los doctores del turno

    public static function assigment(CreateAreaAssigmentRequest $request) //asignacion de consultorio
    {
        $e = Employe::where('id', $request->employe_id)->first();
        $a = Area::where('id', $request->area_id)->first();

        if (!is_null($a) && !is_null($e)) {
            $date = Carbon::now()->locale('en');
            //dd($date);

           // dd($e->schedule == $date);
            if ($e->schedule == $date) {
                return response()->json([
                    'message' => 'El medico no trabaja hoy',
                ]);
            }

            // if ($e->position->name != 'doctor') {
            //     return response()->json([
            //         'message' => 'Este empleado no es un medico',
            //     ]); 
            // }

            $employeasignado = AreaAssigment::where('employe_id', $e->id)->whereDate('created_at', $date)->first();

            if ($employeasignado != null) {
                return response()->json([
                    'message' => 'Empleado ya ha sido asignado',
                ]);    
            }

            $turno = Schedule::where('employe_id', $e->id)->where('day', strtolower($date->dayName))->first();
            //dd($e);

            if ($turno->turn == 'mañana') {
                $areaOcupada = AreaAssigment::where('area_id', $a->id)->whereDate('created_at', $date)->whereTime('created_at', '<=', '12:00')->first();
            }else{
                $areaOcupada = AreaAssigment::where('area_id', $a->id)->whereDate('created_at', $date)->whereTime('created_at', '>', '14:00')->first();
            }
            
            if ($areaOcupada != null) {
                return response()->json([
                    'message' => 'Consultorio Ocupado',
                ]);    
            }

            $areaAssigment = AreaAssigment::create([
            'employe_id'  => $request['employe_id'],
            'area_id'     => $request['area_id'],
            'branch_id' => 1,
            ]);

            $this->update_area($request);

            return response()->json([
                'message' => 'consultorio asignado',
            ]);
        }else{
            return response()->json([
                'message' => 'Empleado o consultorio invalido',
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Employe;
Use App\Area;
Use App\Billing;
Use App\AreaAssigment;
use Carbon\Carbon;
use App\Http\Requests\CreateBillingRequest;
use App\Http\Requests\CreateAreaAssigmentRequest;
use App\Schedule;
use App\TypeArea;
use App\Person;
use App\InputOutput;
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
        $reservations = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->get();
        $aprobadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->get(); //mostrar las reservaciones solo del dia
        
        $canceladas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('cancel')->get(); //mostrar las reservaciones solo del dia
        
        $reprogramadas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('reschedule')->get(); //mostrar las reservaciones solo del dia

        $suspendidas = Reservation::with('person', 'patient.image', 'patient.historyPatient', 'speciality')->whereDate('date', Carbon::now()->format('Y-m-d'))->whereNotNull('discontinued')->get(); //mostrar las reservaciones solo del dia

        return view('dashboard.checkin.index', compact('reservations', 'aprobadas', 'canceladas', 'suspendidas', 'reprogramadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypeArea::with('areas.image')->where('name', 'Consultorio')->get();
        //dd($types);

       return view('dashboard.checkin.create', compact('types'));
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

    public function statusIn(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required',
            'employe_id'  => 'required',
        ]);

        $p = Patient::where('person_id', $request->person_id)->first();
        $io = InputOutput::where('person_id', $p->id)->where('employe_id', $request->employe_id)->first();
           
        if (empty($io)) {
            InputOutput::create([       
                'person_id' =>  $data['person_id'],  //paciente tratado
                'inside' => 'dentro',
                'outside' => null,
                'employe_id' =>  $data['employe_id'],  //medico asociado para cuando se quiera buscar todos los pacientes visto por el mismo medico
                'branch_id' => 1,
            ]);

            return response()->json([
                'message' => 'Paciente dentro del consultorio',
            ]);
        }else{
            return response()->json([
                'message' => 'El paciente ya se encuentra adentro',
            ]);
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

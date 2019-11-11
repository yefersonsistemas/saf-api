<?php

namespace App\Http\Controllers\API;

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
        //
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
        
    //hacer metodo que muestre solo los doctores del turno

    public static function assigment(CreateAreaAssigmentRequest $request) //asignacion de consultorio
    {
        $e = Employe::where('id', $request->employe_id)->first();
        $a = Area::where('id', $request->area_id)->first();

        if (!is_null($a) && !is_null($e)) {
            $date = Carbon::now();

            // if ($e->position->name != 'doctor') {
            //     return response()->json([
            //         'message' => 'Este empleado no es un medico',
            //     ]); 
            // }

            $employeasignado = AreaAssigment::where('employe_id', $e->id)->whereDate('created_at', $date)->first();

            if ($employeasignado != null) {
                return response()->json([
                    'message' => 'Empleado ya ha sido asigando',
                ]);    
            }

            $turno = Schedule::where('employe_id', $e->id)->where('day', ucfirst($date->dayName))->first();

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

            return response()->json([
                'message' => 'consultorio asignado',
            ]);
        }else{
            return response()->json([
                'message' => 'Empleado o consultorio invalido',
            ]);
        }
    }

    public function statusIn(Request $request)
    {
        $p = Person::where('id', $request->id)->first();
        $e = Employe::where('id', $request->id)->first();

        $data = $request->validate([
            'person_id' => 'required',
            'employe_id'  => 'required',
        ]);
           
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
        
    }

    public function exams_previos()
    {
        
    }
}

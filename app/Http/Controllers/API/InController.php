<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Employe;
Use App\Area;
Use App\Billing;
Use App\Schedules;
Use App\AreaAssigment;
use App\Http\Requests\CreateBillingRequest;
use App\Http\Requests\CreateAreaAssigmentRequest;
//use App\Http\Controllers\CitaController;


class InController extends Controller
{

    public static function search(Request $request)
    {
       $area = Area::Where('id', $request->id)->first(); 

        if ($area != null) {  //si existe
            return response()->json([
                'message' => 'Consultorio ocupado',
            ], 201);
            
        }else{  //caso de que no exista
            return response()->json([
                'message' => 'Consultorio no encontrado',
            ], 201);
        }
    }

    public static function assigment(CreateAreaAssigmentRequest $request) //asignacion de consultorio
    {
        $e = Employe::find($id);
        $a = Area::where('id', $request->id);

        if (!is_null($a)) {
            $areaAssigment = AreaAssigment::create([
            'employe_id'  => $request->id,
            'area_id'     => $request->id,
            ]);
        }
        
            return response()->json([
                'message' => 'consultorio asignado',
            ], 201);
        
    }

    public static function billing(CreateBillingRequest $request){  //facturacion
        
        $billing = Billing::create([
            'procedure_employe_id' => $request['procedure_employe_id'],
            'person_id' => $request['person_id'],
            'patient_id' => $request['patient_id'],
            'type_payment_id' => $request['type_payment_id'],
            'type_currency' => $request['type_currency'],
            'branch_id' => 1
        ]);

        return response()->json([
            'message' => 'Factura creada',
        ], 201);
    }

    // public function cite(){  //crear cita
    //     CitaController::create_cite();
    // }
}

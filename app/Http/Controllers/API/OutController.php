<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Specilaity;
Use App\Employe;
Use App\Area;
Use App\Billing;
Use App\Schedules;
use App\Http\Requests\CreateBillingRequest;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\InController;

class OutController extends Controller
{
    public function buscar(Request $request)
    {
        InController::search();
    }
    
    public function asignacion() //asignacion de consultorio
    {
        InController::assigment();
    }

    public function factura(){ //facturacion
        InController::billing();
    }

    public function cite(){  //crear cita
        CitaController::create_cite();
    }
}

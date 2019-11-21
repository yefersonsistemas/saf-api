<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\Medicine;
use App\Exam;
use App\Diagnostic;
use App\Procedure;
use App\Surgery;
use Carbon\Carbon;
use App\Http\Requests\CreateDiagnosticRequest;
use App\Employe;
use App\Billing;
use App\Reservation;
use App\Person;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
       $patients = Reservation::with('patient.historyPatient')->where('person_id',$id )
                                ->whereDate('date', Carbon::now()->format('Y-m-d'))->get();
                                // dd($patients);
                                // dd($patients);

        // if (!is_null($patients)) {
        //     return response()->json([
        //         'reservas' => $patients,
        //     ]);
        // }

       
      return view('dashboard.doctor.citasPacientes',compact('patients'));
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
    public function show($id )
    {

        $history=Reservation::with('patient.historyPatient')->where('id',$id)
        ->whereDate('date', Carbon::now()->format('Y-m-d'))->get();
        // dd($history);
     return view('dashboard.doctor.historiaPaciente', compact('history'));
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

    public function crearDiagnostico(){
        return view('dashboard.doctor.crearDiagnostico');
    }

    public function crearRecipe(){
        return view('dashboard.doctor.crearRecipe');
    }
    public function crearReferencia(){
        return view('dashboard.doctor.crearReferencia');
    }

    
}

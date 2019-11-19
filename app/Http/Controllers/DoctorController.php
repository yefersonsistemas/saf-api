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
    public function index(Request $request)
    {
       $reservations = Reservation::with('person')->whereDate('date', Carbon::now()->format('Y-m-d'))
                        ->get(); //mostrar las reservaciones solo del dia

        if (!empty($reservations)) {
            $reservations = $reservations->each(function( $reservation){
                $patient = Person::where('id', $reservation->patient_id)->first();
                if ($patient != null) {
                    $reservation->patient = $patient;
                    return $reservation; 
                }
            });
           
        }

        
      return view('dashboard.doctor.citasPacientes',compact('reservations'));
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

    
}

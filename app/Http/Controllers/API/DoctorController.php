<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Patients;
use App\Mediciens;
use App\Examenes;
use App\Diagnostic;
use App\Carbon\Carbon;
use App\Employe;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patients::whereDate('date', Carbon::now()->format('d/m/Y'))->get();

        return response()->json([
            'patient' => $patients,
        ]);
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

    public function create_diagnostic(Request $request){

        $diagnostic = Diagnostic::create([
            'petient_id' => $request->patient_id,
            'description' => $request->description,
            'reason' => $request->reason,
            'treatment' => $request->treatment,
            'annex' => $request->annex,
            'next_cite' => $request->next_cite,
            'employe_id' => $request->employe_id,
        ]);
    }

    public function list()
    {
        $doctor = Employe::with('person.user','procedures')->get();

        $doctors = $doctor->each(function ($doctor)
        {
            $doc = $doctor->person->user->role('doctor');
            // $doc->load('procedures');
            return $doc;
        });

        return response()->json([
            'doctors' => $doctors,
        ]);
    }
}

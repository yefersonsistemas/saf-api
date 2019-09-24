<?php

namespace App\Http\Controllers;

use App\Diagnostic;
use Illuminate\Http\Request;
use App\Patient;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateDiagnosticRequest;
use Carbon\Carbon;


class DiagnosticController extends Controller
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
    public function create(Patient $patient)
    {
        return view('dashboard.diagnostics.create', ['patient' => $patient]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiagnosticRequest $request, Patient $patient)
    {
        $user      = Auth::user();
        $data      = $request->validated();
            Diagnostic::create([
                'description' => $data['description'],
                'reason' => $data['reason'],
                'treatment' => $request->treatment,
                'annex' => $request->annex,
                'next_cite' => Carbon::parse($request->next_cite),
                'patient_id' => $patient->id,
                'user_id' => $user->id,
            ]);
            
        return redirect()->route('patients.show', $patient)->withSuccess('El diagnostico fue guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostic $diagnostic)
    {
       $patient = $diagnostic->patient;
       return view('dashboard.diagnostics.show', compact('diagnostic','patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostic $diagnostic)
    {
        //
    }
}

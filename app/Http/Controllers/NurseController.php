<?php

namespace App\Http\Controllers;

use App\File;
use App\Informesurgery;
use App\Patient;
use App\Person;
use App\Reservation;
use App\Surgery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\FileAnestesiologo;
use App\FileDoctor;
use App\FileInternista;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surgeries = Surgery::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date', 'asc')->with('patient.person.image', 'employe.person','typesurgeries','area')->get();
        // dd( $surgeries);

        return  view('dashboard.vergel.enfermeria.lista_cirugias', compact('surgeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $surgery)
    {
        // dd($id, $surgery);

        $patient = Patient::with('person')->find($id);
        // dd($patient);
        $surgery = Surgery::where('patient_id',  $patient->id)->find($surgery);
        // dd($surgery);

        return view('dashboard.vergel.enfermeria.create-informe-cirugia', compact('patient', 'surgery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $surgery)
    {
        // dd($request, $surgery);
        $surgery = Surgery::find($surgery);
        dd($surgery);

        if($request->file('file')){
            $surgery = Surgery::find($surgery);
            
            $image = $request->file('file');
            $path = $image->store('public/Internista');
            $path = str_replace('public/', '', $path);
            $image = new FileInternista;
            $image->path = $path;
            $image->fileable_type = "App\Surgery";
            $image->fileable_id = $surgery->id;
            $image->branch_id = 1;
            $image->save();
   
            // dd($image);
            return response()->json(["status" => "success", "data" => $image]);
        }
     

        return redirect()->route('lista_cirugias')->withSuccess('Informe guardado correctamente');
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

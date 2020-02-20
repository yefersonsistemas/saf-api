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
        // dd($id);
        $person = Person::where('id', $id)->first();
        $cirugia = Surgery::with();

        return view('dashboard.vergel.enfermeria.create-informe-cirugia', compact('person'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $patient = Patient::with('surgery')->where('id', $request->patient_id)->first();
        // dd($patient->surgery);
        $person = Person::where('id', $patient->person_id)->first();
        // dd($person);



        if ($request->file != null) {
            // dd($request->file);

            foreach($request->file as $file){
                $image = $request->file('file');
                $path = $file->store('public/exams');
                $path = str_replace('public/', '', $path);
                $image = new File();
                $image->path = $path;
                // $image->path = 'exam'.'\\'.$image;
                $image->fileable_type = "App\Person";
                $image->fileable_id = $person->id;
                $image->branch_id = 1;
                $image->save();

                // dd($image);

                if($image != null){
                    foreach( $patient->surgery as $surgery)
                        $informe = Informesurgery::create([
                            'file_id' => $image->id,
                            'surgery_id' => $surgery->id,
                            'branch_id' => 1,
        
                        ]);
                    }
                    
                    dd($informe );
                }
            }

            // foreach($image as $img){
            //     $informe = Informesurgery::create([
            //         'file_id' => $image->id,
            //         'surgery_id' => $patient->surgery->id,
            //         'branch_id' => 1,

            //     ]);

            //     dd($informe );
            // }
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

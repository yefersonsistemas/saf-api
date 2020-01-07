<?php

namespace App\Http\Controllers;

use App\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employe;
use App\Service;
use App\Image;

class SpecialityController extends Controller
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
        $servicio = Service::get();
        return view('dashboard.director.speciality', compact('servicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $doctor = Employe::find($request->doctor);
        // dd($request);

        $data =  $request->validate([
            'name'   => 'required',
            'description' => 'required',
            'service_id'  => 'required',
        ]);

        $speciality =  Speciality::create([
            'name'            => $data['name'],
            'description'     => $data['description'],
            'service_id'      => $request->service_id,
            'branch_id'       => 1
        ]);
        $image = $request->file('image');
        $path = $image->store('public/speciality');  //se guarda en la carpeta public
        $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en especialidad
        $image = new Image;
        $image->path = $path;
        $image->imageable_type = "App\Speciality";
        $image->imageable_id = $speciality->id;
        $image->branch_id = 1;
        $image->save();

        return redirect()->back()->withSuccess('Registro agregado correctamente');

        // $doctor->speciality()->attach($speciality->id);
        
        // return response()->json([
        //     'message' => 'Especialidad creada satisfactoriamente',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Service::get();
        $speciality = Speciality::find($id); 
        $buscar_service = Service::where('id', $speciality->service_id)->first();
        
        $servi = array($speciality);
        $diff = $servicio->diff($servi);
     
        return view('dashboard.director.speciality-edit', compact('servicio', 'speciality', 'buscar_service', 'diff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->id);
        $speciality = Speciality::with('service')->find($request->id);
        // dd($speciality);

        $speciality->name = $request->name;
        $speciality->description = $request->description;
        $speciality->service_id = $request->service_id;
        $speciality->update();

        if ($request->image != null) {
            $image = $request->file('image');
            $path = $image->store('public/speciality');  //se guarda en la carpeta public
            $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en especialidad
            $image = new Image;
            $image->path = $path;
            $image->imageable_type = "App\Speciality";
            $image->imageable_id = $speciality->id;
            $image->branch_id = 1;
            $image->save();
        }

        return redirect()->route('all.register')->withSuccess('Registro modificado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speciality $speciality)
    {
        //
    }

    public function doctor_S(Request $request){    //medico con todas sus especialidades
        $doctor = Employe::with('person.user', 'speciality')->where('person_id', $request->person_id)->first();

        if (!is_null($doctor)) {

            return response()->json([
                'doctor' => $doctor,
            ]);
        }
    }
 
}

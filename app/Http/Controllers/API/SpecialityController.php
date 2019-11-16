<?php

namespace App\Http\Controllers\API;

use App\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employe;

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
        $doctor = Employe::find($request->doctor);

        $data =  $request->validate([
            'name'   => 'required',
            'description' => 'required',
        ]);

        $speciality =  Speciality::create([
                'name'            => $data['name'],
                'description'     => $request['description'],
                'branch_id'       => 1
            ]);

        $doctor->speciality()->attach($speciality->id);
        
        return response()->json([
            'message' => 'Especialidad creada satisfactoriamente',
        ]);
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
    public function edit(Speciality $speciality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Speciality $speciality)
    {
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeDoctor;

class TypeDoctorController extends Controller
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
        return view('dashboard.director.clase');
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
        
           $data = $request->validate([
            'name' => 'required',
            'comission'  => 'required',
         
        ]);

        $type = TypeDoctor::create([
            'name' => $data['name'],
            'comission'  => $data['comission'],
            'branch_id' => 1
        ]);

        return redirect()->back()->withSuccess('Registro creado correctamente');
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
        // dd($id);
        $type = TypeDoctor::find($id);
        // dd($type);
        return view('dashboard.director.clase-edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $type = TypeDoctor::find($request->id);
        
         $type->name = $request->name;
         $type->comission = $request->comission;
         $type->update();
 
        return redirect()->route('all.register')->withSuccess('Registro modificado'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDoctor $doctor)
    {
        $doctor = TypeDoctor::find($doctor);
        $doctor->delete();
        return redirect()->route('all.register')->withSuccess('Registro eliminado');
    }
}

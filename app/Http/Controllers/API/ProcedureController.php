<?php

namespace App\Http\Controllers;

// use App\Procedure;
use Illuminate\Http\Request;
// use Carbon\Carbon;
// use App\User;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $doctor)
    {   
      /*  $procedures = $doctor->procedures;
        $doctors   = User::role('doctor')->get();
        return view('dashboard.procedures.index', compact('doctor','procedures','doctors'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $doctor)
    {
    /*  $data =  $request->validate([
            'name'   => 'required',
            'name.required' => 'Es obligatorio ingresar nombre del procedimiento.',
            'price'   => 'required',
            'price.required' => 'Es obligatorio precio del procedimiento.',
        ]);
        $procedure =  Procedure::create([
                        'name'            => $data['name'],
                        'price'           => $data['price'],
                        'description'     => $request->description,
                      ]);

        $doctor->procedures()->attach($procedure->id);         
        return redirect()->back()->withSuccess('Registro agregado correctamente');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Procedure $procedure)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedure $procedure)
    {
        //return response()->json($procedure);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procedure $procedure)
    {/*
        $procedure->name          =  $request->name2;
        $procedure->price         =  $request->price2;
        $procedure->description   =  $request->description2; 
        $procedure->save();      
        return response()->json($request->price);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedure $procedure)
    {/*
        $doctor = $procedure->doctors->first();
        $doctor->procedures()->detach($procedure->id);
        $procedure->delete();
        return redirect()->back()->withSuccess('Se ha Eliminacion correctamente');*/
    }
}


<?php

namespace App\Http\Controllers;

use App\Allergy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllergyController extends Controller
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
        return view('dashboard.director.allergy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $allergy = Allergy::create([
            'name' => $data['name'],
            'branch_id' => 1
        ]);

        return redirect()->back()->withSuccess('Registro agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function show(Allergy $allergy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($allergy);
        $allergy = Allergy::find($id);
        // dd($allergy);
        return view('dashboard.director.allergy-edit', compact('allergy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $allergy = Allergy::find($request->id);
        
        $allergy->name = $request->name;
        $allergy->update();
        // dd($allergy);

       return redirect()->route('all.register')->withSuccess('Registro modificado'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allergy = Allergy::find($id);
        $allergy->delete();
        return redirect()->route('all.register')->withSuccess('Alergia eliminada');
    }
}

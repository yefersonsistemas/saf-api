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

        $person = Allergy::create([
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
    public function edit(Allergy $allergy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allergy $allergy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allergy $allergy)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use App\Http\Requests\CreatePersonRequest;

class PersonController extends Controller
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
    public function store(CreatePersonRequest $request)
    {
        $data = $request->validated();
        $data['branch_id'] = 1;

        $person = Person::create($data);
        if ($person != null) {
            return response()->json([
                201,
                'paciente' => $person,
            ]);
        }else{
            return 'no registrado';
        }
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

    public function update_person(Request $request) //cambiar direccion de paciente en la historia
  {
    $patient = Person::find($request->id);

    $patient->address = $request->address;
    $patient->phone = $request->phone;
    $patient->email = $request->email;

    if($patient->save()){
        return response()->json([
            'message' => 'Datos modificados',
        ]);
    }else{
        return response()->json([
            'message' => 'No se pudo actualizar los datos',
        ]);
    }
  }
}

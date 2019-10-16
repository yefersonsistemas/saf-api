<?php

namespace App\Http\Controllers\API;

use App\Employe;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Position;
Use App\Visitor;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employe = Employe::with('person', 'position')->get();

        $employes = $employe->map(function ($item) {
            $item->position;
            $item->person->status = 'pendiente';
            return $item;
        });

        return response()->json([
            'employes' => $employes,
        ]);
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
        $data = $request->validate([
            'name' => 'required',
            'type_dni'  => 'required',
            'dni'   => 'required',
            'lastname' => 'required',
            'phone'     => 'required',
            'email' =>  'required',
            'address'   => 'required',
            'position_id'   => 'required',
        ]);

        $person = Person::create([
            'name' => $data['name'],
            'type_dni'  => $data['type_dni'],
            'dni'   => $data['dni'],
            'lastname' => $data['lastname'],
            'phone'     => $data['phone'],
            'email' =>  $data['email'],
            'address'   => $data['address'],
            'branch_id' => 1
        ]);

        $employe = Employe::create([
            'person_id' => $person->id,
            'position_id'   =>$request->position_id,
            'branch_id' => 1
        ]);

        return response()->json([
            'message' => 'Empleado creado',
        ]);
    }

    public function positions()
    {
        $positions = Position::all();
        return response()->json([
            'positions' => $positions,
        ]);
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

    public function statusIn(Request $request)
    {
        $person = Person::with('employe')->where('id', $request->id)->first(); //busco el id 
       // dd($person);
        if (!is_null($person)) {

            $visitor = Visitor::create([       //se crea y se guarda automaticamente el cambio de estado
                'person_id' => $person->id,
                'type_visitor' => 'Empleado',
                'status' => 'dentro',
                'branch_id' => 1,
            ]);

            event(new Security($visitor)); //envia el aviso a recepcion de que el paciente citado llego 
        }
        
        return response()->json([
            'message' => 'Empleado dentro de las instalaciones',
        ]);
    }

    public function statusOut(Request $request)
    {
        $person = Visitor::where('person_id', $request->person_id)->orderBy('created_at', 'desc')->first(); //busco el visitante comparando los id 

            $visitors = Visitor::create([                      
                'person_id' => $person->person_id,
                'type_visitor' => $person->type_visitor,
                'status' => 'fuera',
                'branch_id' => 1
            ]);

        return response()->json([
            'message' => 'Empleado fuera de las instalaciones',
        ]);
    }
}

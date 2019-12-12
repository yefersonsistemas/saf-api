<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Employe;
use App\Position;
use App\Speciality;
use App\Image;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employe::with('person', 'position', 'speciality')->get();

        return view('dashboard.director.index', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = Position::where('name', 'doctor')->first();
        // dd( $position);
        $speciality = Speciality::all();
        return view('dashboard.director.created', compact('position', 'speciality'));
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

        if (!is_null($employe)) {
            if (!empty($request->speciality)) {
                foreach ($request->speciality as $speciality) {
                    $especialidad = Speciality::find($speciality);
                    $employe->speciality()->attach($especialidad); 
                }
            }
        }
          
        $image= Image::create([
            'path'   => $request->image,
            'imageable_type' => 'App\Employe',
            'imageable_id' => $employe->id,
            'branch_id' => 1
        ]);


        return redirect()->route('employe.index');
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
}

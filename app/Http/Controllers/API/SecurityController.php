<?php

namespace App\Http\Controllers\API;

use App\Employe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reservation;
Use App\Visitor;
Use App\Person;
use Carbon\Carbon;
use App\Http\Requests\CreateVisitorRequest;
use App\Events\Security;

class SecurityController extends Controller
{
   /* protected $data = [
        'patients'
    ];*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::whereDate('date', Carbon::now()->format('Y-m-d'))->where('status','Aprobado')->get(); //mostrar las reservaciones solo del dia
        $visitors = Visitor::whereDate('created_at', Carbon::now()->format('Y-m-d'))
                            ->where('type_visitor', 'Visitante')
                            ->orWhere('type_visitor', 'Paciente')->get(); //obtener solo registros creados hoy
        //dd($visitors);
        $all = collect([]);

            $patients = $reservations->map(function ($item) {
                $item->person->category = 'paciente';
                    return $item;
            });
    
            $visitors = $visitors->map(function ($item) {
                $item->person->category = 'visitante';
                return $item;
            });
        
        $all = $patients->concat($visitors);

        return response()->json([
            'all' => $all,
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
       //
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
    
    public function search(Request $request)
    {
       // $persons = Person::all()->dd();
        $person = Person::where('dni', $request->dni)->first(); //busco dni para saber si existe

        if (!is_null($person)) {  //si existe
           $this->create_visitor($person); //lleno solo la tabla visitor

            return response()->json([
                //'person' => $person,
                'message' => 'Visitante creado',
                'activo' => 'true',
            ]);

        }else{  //caso de que no exista
            return response()->json([
                'message' => 'Visitante no encontrado debe de crearlo',
                'activo' => 'false',
            ]);
        }
    }

    public function all_visitor(CreateVisitorRequest $request)
    {                                 //no hay registro de esa persona
        $person = Person::create([  //agregar un visitante ya sea un futuro paciente o no
            'type_dni'    => $request->type_dni,
            'dni'         => $request->dni,
            'name'        => $request->name,
            'lastname'    => $request->lastname,
            'address'     => $request->address,
            'email'       => $request->email,
            'branch_id'   => 1,
        ]);

        $this->create_visitor($person);

        return response()->json([
            'message' => 'Visitante creado',
        ]);

    }

    public function create_visitor(Person $person)
    {
        $visitor = Visitor::create([
            'person_id'      => $person->id,
            'type_visitor'   => 'Visitante', 
            'status'         => 'dentro',
            'branch_id'      => 1
        ]);

        $person->visitor()->associate($visitor->id); //asociar un visitante a una persona que ya tiene registro

        return response()->json([
            'message' => 'Visitante creado',
        ]);
    }

    public function statusIn(Request $request)
    {
        $person = Person::where('id', $request->id)->first(); //busco el id 
        $v = Visitor::where('person_id', $request->id)->first(); 
       
        if (!is_null($person)) {
            $v->delete(); //borrado logico

               $visitor = Visitor::create([       //se crea y se guarda automaticamente el cambio de estado
                   'person_id' => $person->id,
                   'type_visitor' => 'Paciente',
                   'status' => 'dentro',
                   'branch_id' => 1,
               ]);

            // event(new Security($visitor)); //envia el aviso a recepcion de que el paciente citado llego 

            return response()->json([
                'message' => 'Visitante dentro de las instalaciones',
            ]);
        }
    }

    public function statusOut(Request $request)
    {
        $person = Visitor::where('person_id', $request->person_id)->orderBy('created_at', 'desc')->first(); //busco el visitante comparando los id 
        $v = Visitor::where('person_id', $request->person_id)->first();
        
        if (!is_null($person)) {
            $v->delete();

            $visitors = Visitor::create([                      
                'person_id' => $person->person_id,
                'type_visitor' => $person->type_visitor,
                'status' => 'fuera',
                'branch_id' => 1
                ]);

            return response()->json([
                'message' => 'Visitante fuera de las instalaciones',
            ]);
        }
    }
}

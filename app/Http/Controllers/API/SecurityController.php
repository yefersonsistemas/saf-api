<?php

namespace App\Http\Controllers\API;
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
        $fecha = Carbon::now()->format('Y-m-d');
        // dd($fecha);
        $reservations = Reservation::whereDate('date', Carbon::now()->format('d/m/Y'))->where('status','Aprobado')->get(); //mostrar las reservaciones solo del dia
        $visitors = Visitor::whereDate('created_at', Carbon::now()->format('Y-m-d'))->get(); //obtener solo registros creados hoy 
        //dd($visitors);
        $patients = $reservations->map(function ($item, $key) {
            return $item->person;
        });

        $visitors = $visitors->map(function ($item, $key) {
            return $item->person;
        });

        return response()->json([
            'reservation' => $patients,
            'visitor' =>  $visitors,
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
    
    public function search(Request $request)//esta buena
    {
       // $persons = Person::all()->dd();
        $person = Person::where('dni', $request)->first(); //busco dni para saber si existe

        if ($person != null) {  //si existe
            $this->create_visitor($person); //lleno solo la tabla visitor

            return response()->json([
                'message' => 'Visitante creado',
            ], 201);
            
        }else{  //caso de que no exista
            return response()->json([
                'message' => 'Visitante no encontrado debe de crearlo',
            ], 201);
        }
    }

    public function all_visitor(CreateVisitorRequest $request)
    {
        $person = Person::create([  //agregar un visitante ya sea un futuro paciente o no
            'type_dni'    => $request->type_dni,
            'dni'         => $request->dni,
            'name'        => $request->name,
            'lastname'    => $request->lastname,
            'address'     => $request->address,
            'email'       => $request->email,
           // 'branch_id'   => 1,
        ]);

        $this->create_visitor($person);

        return response()->json([
            'message' => 'Visitante creado',
        ], 201);

    }

    public function create_visitor($person)
    {
        $visitor = Visitor::create([
            'person_id'      => $person->id,
            'type_visitor'   => 'visitante', 
            'status'         => 'dentro',
        ]);
    }

    public function statusIn(CreateVisitorRequest $request)
    {
        $person = Person::where('id', $request->id)->first(); //busco el id 
        
        $visitor = Visitor::create([       //se crea y se guarda automaticamente el cambio de estado
            'person_id' =>$person->person_id,
            'type_visitor' => 'paciente',
            'status' => 'dentro',
        ]);

        //  event(new Security($visitor));
        
        return response()->json([
            
            'message' => 'Visitante dentro de las instalaciones',
        ]);
    }

    public function statusOut(CreateVisitorRequest $request)
    {
        $person = Visitor::where('person_id', $request->person_id)->orderBy('created_at', 'desc')->first(); //busco el visitante comparando los id 

            $visitors = Visitor::create([                      
                'person_id' => $person->person_id,
                'type_visitor' => $person->type_visitor,
                'status' => 'fuera',
            ]);
            
        return response()->json([
            'message' => 'Visitante fuera de las instalaciones',
        ]);
    }
}

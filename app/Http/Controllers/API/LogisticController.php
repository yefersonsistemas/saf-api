<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\TypeSupplie;
use App\Supplie;
use App\MachineEquipment;
use App\TypeEquipment;
use App\Http\Requests\CreateSupplieRequest;
use App\Http\Requests\CreateEquipmentRequest;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplie = Supplie::all();
        $equipment = MachineEquipment::all();

       if (  == $supplie) {
            return response()->json([
            'supplie' => $supplie,
        ]);
       }else{
            return response()->json([
            'equipment' =>  $equipment,
        ]);
       }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateSupplieRequest $request)
    {/*
        $supplie = Supplie::create([
            'date'               => $request['date'],
            'presentation'       => $request['presentation'],
            'type_supplie_id'    => $typesupplie->type_supplie_id,

        ]);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplieRequest $request)
    {/*
        $data = $request->validated();
        $supplie = Supplie::create($data);

           return response()->json([
            'message' => 'Insumo creado exitosamente',
        ], 201);*/

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
    public function edit(Supplie $supplie)
    {/*
        $typesupplie = TypeSupplie::where('id', $request->id)->first();

        $supplie = Supplie::create([
            'date'               => $request['date'],
            'presentation'       => $request['presentation'],
            'type_supplie_id'    => $typesupplie->type_supplie_id,

        ]);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSupplieRequest $request, $id)
    {/*
        $supplie = Supplie::find($id);
        $data = $request->validated();
        $supplie->update($data);

           return response()->json([
            'message' => 'Insumo actualizado exitosamente',
        ], 201);*/

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplie $supplie)
    {/*
        $supplie->delete();

        return response()->json([
            'message' => 'Insumo eliminado',
        ], 201);*/
    }
 
    //insumos
    public function create_supplie(CreateSupplieRequest $request){

        $supplie = Supplie::create([
            'name'               => $request['name'],
            'presentation'       => $request['presentation'],
            'type_supplie_id'    => $type_supplie->type_supplie_id,
        ]);

          return response()->json([
            'message' => 'Insumo creado exitosamente',
        ], 201);
    }

    public function edit_supplie(CreateSupplieRequest $request){

        $supplie = Supplie::where('id', $request->id)->first();

        if ($supplie != null ){
            $supplie->update($request->all());

             return response()->json([
            'message' => 'Modificacion exitosa',
        ], 201);
        }
    }

      public function delete_supplie(CreateSupplieRequest $request){

        $supplie = Supplie::where('id', $request->id)->first();

        if ($supplie != null ){
            $supplie->delete($request->all());

             return response()->json([
            'message' => 'Insumo eliminado',
        ], 201);
        }
    }

    public function assigment_suplie(){

    }
}

            //equipos
    public function create_equipment(CreateEquipmentRequest $request){

        $equipment = MachineEquipment::create([
            'name'               => $request['name'],
            'description'        => $request['description'],
            'type_equipment_id'  => $type_equipment->type_equipment_id,
        ]);

          return response()->json([
            'message' => 'Equipo creado exitosamente',
        ], 201);
    }

    public function edit_equipment(CreateEquipmentRequest $request){

        $equipment = MachineEquipment::where('id', $request->id)->first();

        if ($equipment != null ){
            $equipment->update($request->all());

             return response()->json([
            'message' => 'Modificacion exitosa',
        ], 201);
        }
    }

    public function delete_equipment(CreateEquipmentRequest $request){

        $equipment = MachineEquipment::where('id', $request->id)->first();

        if ($equipment != null ){
            $equipment->delete($request->all());

             return response()->json([
            'message' => 'Equipo eliminado',
        ], 201);
        }
    }

     public function assigment_equipment(){
        
    }

}

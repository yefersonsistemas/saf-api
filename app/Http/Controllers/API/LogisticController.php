<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\TypeSupplie;
use App\Supplie;
use App\MachineEquipment;
use App\TypeEquipment;
use App\Http\Requests\CreateSupplieRequest;

class LogisticController extends Controller
{
    public function index()
    {
        $supplie = Supplie::where('type_supplie_id', $request->type_supplie_id)->first();
        $equipment = MachineEquipment::where('type_equipment_id', $request->type_equipment_id)->first();

       if ($supplie == $supplie->type_supplie->id) {
            return response()->json([
            'supplie' => $supplie,
        ]);
       }elseif($equipment == $equipment->type_equipment->id){
            return response()->json([
            'equipment' =>  $equipment,
        ]);
       }
       
    }

    //insumos
    public function create_supplie(CreateSupplieRequest $request){

        $supplie = Supplie::create([
            'name'               => $request['name'],
            'presentation'       => $request['presentation'],
            'type_supplie_id'    => $request->type_supplie_id,
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

    public function assigment_suplie(CreateSupplieRequest $request){
        $supplie = Supplie::where('id', $request->id);
        $equipment = MachineEquipment::where('id', $request->id);

        if ($suplie != null) {
           
            $inventoryarea = InventoryArea::create([
                'quantity_Assigned'     => $request['quantity_Assigned'],
                'quantity_Used'         => $request['quantity_Used'],
                'quantity_Available'    => $request['quantity_Available'],
                'type_area_id'          => $request['type_area_id'],
                'inventory_id'          => $request['inventory_id'],
            ]);
        }
    }

    
    //equipos
    public function create_equipment(CreateSupplieRequest $request){

        $equipment = MachineEquipment::create([
            'name'               => $request['name'],
            'description'        => $request['description'],
            'type_equipment_id'  => $type_equipment->type_equipment_id,
        ]);

          return response()->json([
            'message' => 'Equipo creado exitosamente',
        ], 201);
    }

    public function edit_equipment(CreateSupplieRequest $request){

        $equipment = MachineEquipment::where('id', $request->id)->first();

        if ($equipment != null ){
            $equipment->update($request->all());

             return response()->json([
            'message' => 'Modificacion exitosa',
        ], 201);
        }
    }

    public function delete_equipment(CreateSupplieRequest $request){

        $equipment = MachineEquipment::where('id', $request->id)->first();

        if ($equipment != null ){
            $equipment->delete($request->all());

             return response()->json([
            'message' => 'Equipo eliminado',
        ], 201);
        }
    }

     public function assigment_equipment(CreateSupplieRequest $request){
        $equipment = MachineEquipment::where('id', $request->id);

        if ($equipment != null) {
           
            $inventoryarea = InventoryArea::create([
                'quantity_Assigned'     => $request['quantity_Assigned'],
                'quantity_Used'         => $request['quantity_Used'],
                'quantity_Available'    => $request['quantity_Available'],
                'type_area_id'          => $request['type_area_id'],
                'inventory_id'          => $request['inventory_id'],
            ]);
        }
    }

    public function list_inventory(){
        $inventory = Inventory::all();

        return response()->json([
            'inventory' => $inventory,
        ]);

    }

    public function list_inventoryArea(){
        $inventoryarea = InventoryArea::all();

        return response()->json([
            'inventoryarea' => $inventoryarea,
        ]);

    }

    public function registercleanig(){
        
        $register = TypeCleanig::create([
            'name' => $request['name'],
            'type_cleaning' => $request['type_cleaning'],
        ]);

        return response()->json([
            'message' => 'Limpieza registrada',
        ], 201);
    }

    public function record_cleaning(){
        $record = CleaningRecord::all();

        return response()->json([
            'record' => $record,
        ], 201);
    }

}

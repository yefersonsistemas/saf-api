<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TypeSupplie;
use App\Supplie;
use App\MachineEquipment;
use App\TypeEquipment;
use App\Inventory;
use App\InventoryArea;
use App\Http\Requests\CreateSupplieRequest;
use App\Http\Requests\CreateEquipmentRequest;

class LogisticController extends Controller
{
    public function index()
    {
        $supplie = Supplie::all();
        $equipment = MachineEquipment::all();

        return response()->json([
            'supplie' => $supplie,
            'equipment' =>  $equipment,
        ]);
       
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
        ]);
    }

    public function edit_supplie(CreateSupplieRequest $request, $id){

        $supplie = Supplie::where('id', $request->id)->first();

        if ($supplie != null ){

            $equipment->name = $request->name;
            $equipment->type_supplie_id = $request->type_supplie_id;
            $equipment->presentation = $request->presentation;
            $equipment->update();

             return response()->json([
            'message' => 'Modificacion exitosa',
        ]);
        }
    }

      public function delete_supplie(CreateSupplieRequest $request, $id){

        $supplie = Supplie::where('id', $request->id)->first();

            $supplie->delete($request->all());

             return response()->json([
            'message' => 'Insumo eliminado',
        ]);
    }

    public function assigment_suplie(CreateSupplieRequest $request){
        $supplie = Supplie::where('id', $request->id);
        $equipment = MachineEquipment::where('id', $request->id);

        if ($supplie != null) {
           
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
    public function create_equipment(CreateEquipmentRequest $request){
        
        $equipment = MachineEquipment::create([
            'name'               => $request['name'],
            'description'        => $request['description'],
            'type_equipment_id'  => $request['type_equipment_id'],
            'branch_id'          => 1 
        ]);

        //$equipment = MachineEquipment::all()->dd();

          return response()->json([
            'message' => 'Equipo creado exitosamente',
        ]);
    }


    public function edit_equipment(Request $request){

        $equipment = MachineEquipment::where('id', $request->id)->first();

        if ($equipment != null ){

            $equipment->name = $request->name;
            $equipment->description = $request->description;
            $equipment->type_equipment_id = $request->type_equipment_id;
            $equipment->update();

                return response()->json([
                'message' => 'Modificacion exitosa',
            ]);
        }
    }

    public function delete_equipment(Request $request){

        $equipment = MachineEquipment::where('id', $request->id)->first();

            $equipment->delete($request->all());

             return response()->json([
            'message' => 'Equipo eliminado',
        ]);
    }

     public function assigment_equipment(CreateEquipmentRequest $request){
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

    public function list_inventory(){  //sirve para report
        $inventory = Inventory::all();

        return response()->json([
            'inventory' => $inventory,
        ]);

    }

    public function list_inventoryArea(){ //sirve para report
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
        ]);
    }

    public function record_cleaning(){
        $record = CleaningRecord::all();

        return response()->json([
            'record' => $record,
        ]);
    }

}

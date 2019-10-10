<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplie;
use App\MachineEquipment;
use App\Inventory;
use App\InventoryArea;
use App\CleaningRecord;
use App\Employe;
use App\Http\Requests\CreateSupplieRequest;
use App\Http\Requests\UpdateSupplieRequest;
use App\Http\Requests\CreateEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Requests\CreateInventoryAreaRequest;
use App\Http\Requests\CreateTypeCleaningRequest;

class LogisticController extends Controller
{
    public function index()
    {
        $supplie = Supplie::with('typesupplie')->get();
        $equipment = MachineEquipment::with('typeequipment')->get();

        return response()->json([
            'supplie' => $supplie,
            'equipment' =>  $equipment,
        ]);
       
    }

    //insumos
    public function create_supplie(CreateSupplieRequest $request)
    {
        $supplie = Supplie::create([
            'name'               => $request['name'],
            'type_supplie_id'    => $request['type_supplie_id'],
            'presentation'       => $request['presentation'],
            'branch_id'          => 1
        ]);
         
          return response()->json([
            //'supplie' => $supplie,
            'message' => 'Insumo creado exitosamente',
        ]);
    }

    public function edit_supplie(UpdateSupplieRequest $request, $id){

        $supplie = Supplie::find($id);

            if (!is_null($supplie)){

            $supplie->name = $request->name;
            $supplie->type_supplie_id = $request->type_supplie_id;
            $supplie->presentation = $request->presentation;
        
            if($supplie->save()){
                return response()->json([
                    'supplie'  => $supplie,
                    'message' => 'Modificacion exitosa',
                ]);
            }
        }
    }

    public function delete_supplie($id){

        $supplie = Supplie::find($id);

            if(!is_null($supplie)){
                $supplie->delete();

                return response()->json([
                'message' => 'Insumo eliminado',
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

          return response()->json([
            'message' => 'Equipo creado exitosamente',
        ]);
    }


    public function edit_equipment(UpdateEquipmentRequest $request, $id){

        $equipment = MachineEquipment::find($id);

        if (!is_null($equipment)){

            $equipment->name = $request->name;
            $equipment->description = $request->description;
            $equipment->type_equipment_id = $request->type_equipment_id;
           // $equipment->save();
           
            if($equipment->save()){
                 return response()->json([
                    'equipment'  => $equipment,
                    'message' => 'Modificacion exitosa',
                ]);
            }
        }
    }

    public function delete_equipment($id){

        $equipment = MachineEquipment::find($id);

          if(!is_null($equipment)){
           $equipment->delete();
 
                return response()->json([
                'message' => 'Equipo eliminado',
                ]);
            }
    }

    public function assigment(CreateInventoryAreaRequest $request)
    {    
        $inventoryarea = InventoryArea::create([
            'quantity_Assigned'     => $request['quantity_Assigned'],
            'quantity_Used'         => $request['quantity_Used'],
            'quantity_Available'    => $request['quantity_Available'],
            'area_id'               => $request['area_id'],
            'inventory_id'          => $request['inventory_id'],
            'branch_id'             => 1,
        ]);
        
        return response()->json([
        'inventoryarea' => $inventoryarea,
        'message' => 'Equipo creado exitosamente',
        ]);

    }

    public function list_inventory(){  //sirve para report
        $inventory = Inventory::all();

        return response()->json([
            'inventory' => $inventory,
        ]);

    }

    public function list_inventoryArea(){ //sirve para report
        $inventoryarea = InventoryArea::with('area.image')->get()->groupBy('area_id');

        return response()->json([
            'inventoryarea' => $inventoryarea,
        ]);

    }

    public function registercleanig(CreateTypeCleaningRequest $request)
    {
        $employe = Employe::with('position')->get();

        if ($employe->position->name == 'mantenimiento') {
           
        }

        $register = TypeCleanig::create([
            'name'           => $request['name'],
            'type_cleaning'  => $request['type_cleaning'],
            'branch_id'      => 1,
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

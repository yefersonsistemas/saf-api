<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplie;
use App\MachineEquipment;
use App\Inventory;
use App\InventoryArea;
use App\CleaningRecord;
use App\Http\Requests\CreateSupplieRequest;
use App\Http\Requests\UpdateSupplieRequest;
use App\Http\Requests\CreateEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Requests\CreateInventoryAreaRequest;
use App\Http\Requests\CreateTypeCleaningRequest;
use App\TypeEquipment;
use App\TypeSupplie;
use App\TypeCleaning;

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

    public function escogerS(CreateInventoryAreaRequest $request){
        $area = Area::where('id', $request->area_id)->first();
        $supplie = Inventario::where('id', $request->inventory_id)->first();
        $s = Supplie::with('inventory')->where('id', $request->id)->first();

        if(!is_null($supplie) && !is_null($area)){

            $insumoasignado = InventoryArea::where('area_id', $area->id)->first();

            if ($insumoasignado != null) {
                
                $this->assigment($request);
               
                return response()->json([
                    'message' => 'Insumo asignado exitosamente',
                    ]);        
            }

        }else{
            return response()->json([
                'message' => 'Insumo no asignado',
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
    }

    public function escogerE(Request $request)
    {
        $equipment = Supplie::with('inventory')->where('id', $request->id)->first();

            if(!is_null($equipment)){

                $this->assigment($request);
               
                return response()->json([
                    'message' => 'Equipo asignado exitosamente',
                    ]);  
            }else{
                return response()->json([
                    'message' => 'Equipo no asignado',
                    ]);
                }   
    }
}
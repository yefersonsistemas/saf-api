<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine_pharmacy;
use App\Stock_pharmacy;
use App\Lot_pharmacy;
use App\Medicine;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class FarmaciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //===================== lista de medicamentos =====================
    public function index()
    {
        $stock = Stock_pharmacy::with('medicine_pharmacy.medicine')->get();
        return view('dashboard.vergel.farmaceuta.index',compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //=================crear registro de medicamento===================
    public function create()
    {
        $medicine = Medicine::all();
        return view('dashboard.vergel.farmaceuta.create', compact('medicine'));
    }


    //========================busrcar medicamento=======================
    public function search_medicine(Request $request)
    {
        $decodificar = explode('=', $request->data);
        $medicine = Medicine::find($decodificar[1]);

        return response()->json([
            'medicine' => $medicine,
        ]);
    }


    //========================guardar medicamento=======================
    public function store_medicine(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        
        $medicine = null;
        $medicine = Medicine::create([
            'name' => $data['name'],
            'branch_id' => 1
        ]);
        
        if($medicine != null){
            return response()->json([
                'medicine' => 'Medicamento registrado',$medicine,201
            ]);
        }else{
            return response()->json([
                'medicine' => 'Error al registrar',202
            ]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //=====================guardar registro de medicina=================
    public function store(Request $request)
    {
        // dd($request);
        if($request->id != null){
            $medicine_pharmacy = Medicine_pharmacy::create([
                'medicine_id' => $request->id,
                'marca'  => $request->marca,
                'laboratory'  => $request->laboratory,
                'presentation'  => $request->presentation,
                'measure'  => $request->measure,
                'quantity_Unit'  => $request->quantify_Unit,
                'branch_id' => 1,
            ]);
            
            $fecha = Carbon::now()->format('Y-m-d');
 
            $lot_pharmacy = Lot_pharmacy::create([
                'medicine_pharmacy_id' => $medicine_pharmacy->id,
                'date'  => $fecha,            
                'number_lot'  => $request->number_lot,
                'quantity_total'  => $request->total,
                'date_vence' => $request->date_vence,
                'branch_id' => 1,
            ]);
    
            $stock_pharmacy = Stock_pharmacy::create([
                'medicine_pharmacy_id' => $medicine_pharmacy->id,
                'total' => $request->total,
                'branch_id' => 1,
            ]);
    
            Alert::success('Guardado exitosamente');
            return redirect()->route('farmaceuta.index');
        }else{
            Alert::error('Debe agregar un medicamento');
            return redirect()->route('farmaceuta.create');
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

    //============================agregar lote de medicamentos==============
    public function add($id)
    {
        $medicine_pharmacy = Medicine_pharmacy::with('medicine')->find($id);
        return view('dashboard.vergel.farmaceuta.add',compact('medicine_pharmacy'));
    }


    //===========================guardar lote==============================
    public function add_lote(Request $request, $id)
    {    
        $fecha = Carbon::now()->format('Y-m-d');

        $lot_pharmacy = Lot_pharmacy::create([
            'medicine_pharmacy_id' => $id,
            'date'  => $fecha,            
            'number_lot'  => $request->number_lot,
            'quantity_total'  => $request->total,
            'date_vence' => $request->date_vence,
            'branch_id' => 1,
        ]);

        $buscar_stock = Stock_pharmacy::where('medicine_pharmacy_id', $id)->first();
        $buscar_stock->total = $buscar_stock->total + $request->total;
        $buscar_stock->save();

        Alert::success('Guardado exitosamente');
        return redirect()->route('farmaceuta.index');
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

    //===========================listado de lotes====================
    public function lista_lote()
    {
        $lot_pharmacy = Lot_pharmacy::with('medicine_pharmacy.medicine')->get();
        return view('dashboard.vergel.farmaceuta.lotes',compact('lot_pharmacy'));
    }


     //===========================asignacion====================
     public function create_asignacion()
     {
  
         return view('dashboard.vergel.farmaceuta.asignacion');
    }

     //===========================asignacion====================
     public function asignacion_medicine($id)
     {
        $stock = Stock_pharmacy::with('medicine_pharmacy_id')->get();
        // dd($stock);
        return view('dashboard.vergel.farmaceuta.asignar_medicine',compact('stock'));
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

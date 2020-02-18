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
    public function index()
    {
        $stock = Stock_pharmacy::with('medicine_pharmacy.medicine')->get();
        // dd($stock);
        // $medicine = Medicine_pharmacy::with('medicine')->get();
        // dd($medicine);
        return view('dashboard.farmaceuta.index',compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.farmaceuta.create');
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

        $medicine = Medicine::create([
            'name' => $request->name,
            'branch_id' => 1,
        ]);

        $medicine_pharmacy = Medicine_pharmacy::create([
            'medicine_id' => $medicine->id,
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
            'number_lot'  => 2,
            'quantity_total'  => $request->total,
            'branch_id' => 1,
        ]);

        $stock_pharmacy = Stock_pharmacy::create([
            'medicine_pharmacy_id' => $medicine_pharmacy->id,
            'total' => $request->total,
            'branch_id' => 1,
        ]);

        Alert::success('Guardado exitosamente');
        return redirect()->route('farmaceuta.index');

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

    public function add($id)
    {
        // dd($id);
        $medicine_pharmacy = Medicine_pharmacy::with('medicine')->find($id);

        return view('dashboard.farmaceuta.add',compact('medicine_pharmacy'));
    }

    public function add_lote(Request $request, $id)
    {    
        $fecha = Carbon::now()->format('Y-m-d');

        $lot_pharmacy = Lot_pharmacy::create([
            'medicine_pharmacy_id' => $id,
            'date'  => $fecha,            
            'number_lot'  => 3,
            'quantity_total'  => $request->total,
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

    public function lista_lote()
    {
        $lot_pharmacy = Lot_pharmacy::with('medicine_pharmacy.medicine')->get();
        return view('dashboard.farmaceuta.lotes',compact('lot_pharmacy'));
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

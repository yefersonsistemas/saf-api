<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\ConsultationType;
use App\Patient;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with('patient', 'doctor', 'procedure')->latest()->paginate(25);

        return view('dashboard.sales.index', ['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients          = Patient::all();
        $doctors           = User::role('doctor')->with('procedures')->get();
        $priceUsd          = Configuration::where('name', 'price_usd')->first()->value;
        $paymentTypes      = ['TRANSF', 'EFECTIVO', 'PUNTO V.'];
        
        $consultationTypes = ConsultationType::all();
        
        $banks             = [
            'Banco Caroní', 'Banco Canarias de Venezuela', 'Banco Confederado', 'Bolívar Banco', 'Corp Banca', 'Banco de Crédito de Colombia', 'Banco Do Brasil', 'Banco del Caribe', 'Bancoro', 'Banco de Venezuela', 'Banco Sofitasa', 'Banpro', 'Banco Provincial', 'Banco Tequendama', 'Banesco', 'Banco Fondo Común', 'Banfoandes', 'Banco Occidental de Descuento', 'Banco Venezolano de Crédito', 'Central', 'Banco Guayana', 'Banco Exterior', 'Banco Industrial de Venezuela', 'Banco Mercantil', 'Banco Plaza', 'Citibank', 'Total Bank', 'Instituto Municipal de Crédito Popular', 'Nuevo Mundo', 'Banco Federal', 'Casa Propia', 'Del Sur', 'Mi Casa', 'Merenap',
        ];

        return view('dashboard.sales.create', compact('procedures', 'patients', 'doctors', 'priceUsd', 'paymentTypes', 'banks', 'consultationTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'procedure' => 'required' 
            ],[
            'procedure.required' => 'El procedimiento es necesario',
        ]);
        
        Sale::create([
            'assistant_id'         => Auth::id(),
            'doctor_id'            => $request->doctor,
            'patient_id'           => $request->patient,
            'paid_in_bs'           => $request->paid_in_bs,
            'paid_in_usd'          => $request->paid_in_usd,
            'payment_type'         => $request->payment_type,
            'movement_number'      => $request->movement_number,
            'receiving_bank'       => $request->receiving_bank,
            'observation'          => $request->observation,
            'procedure_id'         => $data['procedure'],
        ]);

        return redirect()->route('sales.index')->withSuccess('Registro agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('dashboard.sales.show', ['sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    public function doctorProcedure($user)
    {
        $user = User::find($user);
        $procedure = $user->procedures;
        return response()->json($procedure);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return back()->withSuccess('Registro eliminado exitosamente');
    }
}

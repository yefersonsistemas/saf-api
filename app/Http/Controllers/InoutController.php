<?php

namespace App\Http\Controllers;

use App\Area;
use App\Billing;
use App\ClassificationSurgery;
use App\Itinerary;
use App\Patient;
use App\Person;
use App\Procedure;
use App\Reservation;
use App\Surgery;
use App\TypeArea;
use App\Typesurgery;
use Carbon\Carbon;
use App\TypeCurrency;
use App\TypePayment;
use Illuminate\Foundation\Testing\WithoutEvents;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use Barryvdh\DomPDF\Facade as PDF; //alias para el componnete de pdf
use RealRashid\SweetAlert\Facades\Alert;
class InoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $day = Surgery::with('patient.person.image','typesurgeries','area','employe')->get();

     $hoy = Surgery::with('patient.person.image','typesurgeries','area','employe', 'file_doctor')->whereDate('date', Carbon::now()->format('Y-m-d'))->get();
     $atendidos = collect([]);
 
     foreach ($hoy as $key) {
         if (!empty($key->file_doctor->first())){
            $atendidos->push($key);
         }
     }
 
     // dd($atendidos);
 
     $mes = Carbon::now()->format('m');
     $año = Carbon::now()->format('Y');
     $surgery1 = Surgery::whereMonth('created_at', '=', $mes)->get();
     $surgery2 = Surgery::whereYear('created_at', '=', $año)->get(); //todas del mismo año
     // dd( $surgery2);
     // cirugias semanal
     $mensual = $surgery1->intersect($surgery2)->count();  //arroja todas del mes y mismo año
 
     return view('dashboard.vergel.in-out.index',compact('day', 'hoy', 'mensual', 'surgery2', 'atendidos'));
    }


    public function agendar_cirugia()
    {
        $clasificacion = ClassificationSurgery::where('name', 'hospitalaria')->first();
       //dd($clasificacion);
        $surgery = Typesurgery::with('image')->where('classification_surgery_id', $clasificacion->id)->get();
        //  dd($surgery);
        $tipo = TypeArea::where('name', 'Quirofano')->first();
        //dd($tipo);
        $area = Area::with('image')->where('type_area_id', $tipo->id)->get();
        return view('dashboard.vergel.in-out.agendar_cirugia', compact('surgery','area'));
    }

    //buscar paciente que tenga cirugia por cancelar
    public function facturacion()
    {
        $fecha = Carbon::now()->format('Y-m-d');
        return view('dashboard.vergel.in-out.facturacion', compact('fecha'));

    }

    //==============finiquitar el proceso de facturacion============
    public function factura(Request $request)
    {
        $surgery = Surgery::with('patient.person', 'employe.person','typesurgeries')->where('id', $request->surgery_id)->first();

        if($surgery->billing_id == null){ //si la factura no se ha generado

            $crear_factura = Billing::create([
                'patient_id'  =>$surgery->patient_id,
                'employe_id'     => $request->employe_id,
                'branch_id' => 1,
            ]);

            $surgery->billing_id = $crear_factura->id;
            $surgery->save();
        }

        $total = $request->total_cancelar;
        $fecha = Carbon::now()->format('Y-m-d');
        $tipo_moneda = TypeCurrency::all();
        $tipo_pago = TypePayment::all();

        return view('dashboard.vergel.in-out.factura', compact('surgery', 'total', 'fecha', 'tipo_moneda', 'tipo_pago'));
    }

    //====================imprimir factura=====================
    public function imprimir_factura(Request $request)
    {
       if($request->person_id != null){
            if($request->factura != null){

                $billing = billing::find($request->factura);
                $billing->person_id = $request->person_id;
                $billing->type_payment_id = $request->tipo_pago;
                $billing->type_currency = $request->tipo_moneda;
                $billing->save();

                $fecha = Carbon::now()->format('Y-m-d');

                $todos = Billing::with('person','employe.person','employe.doctor', 'patient', 'typepayment' , 'typecurrency')->where('id',$billing->id)->first();
                $total_cancelar = $request->total;
                $cirugia = Surgery::with('typesurgeries')->where('billing_id', $billing->id )->first();
                $num_factura = str_pad($billing->id, 5, '0', STR_PAD_LEFT);

                $pdf = PDF::loadView('dashboard.vergel.in-out.print_factura', compact('todos','total_cancelar','fecha', 'num_factura', 'cirugia'));

                return $pdf->stream('factura.pdf');
            }else{
                Alert::error('No puede procesar la factura');
                return redirect()->back();
            }
        }else{
            Alert::error('No puede procesar la factura');
            return redirect()->back();
        }
    }

 
    //===================cirugias del dia==================
    public function day()
    {
        $day = Surgery::with('patient.person.image','typesurgeries','area','employe')->get();
        // dd($day);
        $hoy = Surgery::with('patient.person.image','typesurgeries','area','employe', 'file_doctor')->whereDate('date', Carbon::now()->format('Y-m-d'))->get();
        $atendidos = collect([]);
    
        foreach ($hoy as $key) {
            if (!empty($key->file_doctor->first())){
               $atendidos->push($key);
            }
        }
    
        // dd($atendidos);
    
        $mes = Carbon::now()->format('m');
        $año = Carbon::now()->format('Y');
        $surgery1 = Surgery::whereMonth('created_at', '=', $mes)->get();
        $surgery2 = Surgery::whereYear('created_at', '=', $año)->get(); //todas del mismo año
        // dd( $surgery2);
        // cirugias semanal
        $mensual = $surgery1->intersect($surgery2)->count();  //arroja todas del mes y mismo año
    
        return view('dashboard.vergel.in-out.day',compact('day', 'hoy', 'mensual', 'surgery2', 'atendidos'));
    }

    //-----------------------buscar paciente para inout desde person-----------------------------

    public function search_patients_inout(Request $request){

        // dd($request);
        $person = Person::with('image')->where('type_dni', $request->type_dni)->where('dni', $request->dni)->first();
        // dd($person);

        if (!is_null($person)) {
            $patient = Patient::with('person.image')->where('person_id', $person->id)->first();
            // dd($patient);

            if (!is_null($patient)) {
                // $patient = Patient::with('person')->where('person_id', $person->id)->first();
                return response()->json([
                'patient' => $patient, 201
                ]);
            }else{
                return response()->json([
                    'message' => 'No encontrado',202
                ]);
            }
        }else{
            return response()->json([
                'message' => 'Persona no registrada',202
            ]);
        }
    }

    //============================ buscanco paciente desde la tabla citugia ============================
    public function search_patients_cirugia (Request $request){  // asi se llama adelante inout.search_patients

        // dd($request);
        if(!empty($request->dni)){
        
            $person = Person::where('dni', $request->dni)->first();
            $patient = Patient::where('person_id', $person->id)->first();
            
            if(!empty($patient)){
                $fecha = Carbon::now()->format('Y-m-d');
                $surgery = Surgery::where('patient_id', $patient->id)->where('date', $fecha)->first(); //cirugia del dia
                // dd($surgery);
                if(!empty($surgery)){
                  
                    if($surgery->billing_id == null){
                      if(!empty($surgery->patient_id)){
                        // $patient = Patient::find($surgery->patient_id);
                            //  dd($patient);
                        if(!empty($patient)){
                            $all = collect([]); //definiendo una coleccion|
                            $encontrado = Surgery::with('patient.person', 'employe.person','typesurgeries')->where('patient_id', $patient->id)->get(); // esta es una coleccion
                                //  dd($encontrado);
                            if (!is_null($encontrado)) {
                                return response()->json([
                                    'encontrado' => $encontrado,201,
                                ]);
                            }else{
                                return response()->json([
                                    'encontrado' => 'persona no encontrado', 202
                                ]);
                            }
                        }
                     }else{
                        $all = collect([]); //definiendo una coleccion|
                        $encontrado = Surgery::with('patient.person', 'employe.person','typesurgeries')->where('patient_id', $patient->id)->get(); // esta es una coleccion
                        // dd($encontrado);
                        if (!is_null($encontrado)) {
                            return response()->json([
                                'encontrado' => $encontrado,201,
                            ]);
                        }else{
                            return response()->json([
                                'encontrado' => 'persona no encontrado', 202
                            ]);
                        }
                     }
                     
                    }else{
                        // dd($surgery);
                        return response()->json([
                            'encontrado' => 'Paciente ya facturado', 300
                        ]);
                }
                }else{
                    return response()->json([
                        'encontrado' => 'paciente no encontrado', 202
                    ]);
                }
                    }else{
                        return response()->json([
                            'encontrado' => 'paciente no registrado',202
                        ]);
                        }
            }           
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
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
}

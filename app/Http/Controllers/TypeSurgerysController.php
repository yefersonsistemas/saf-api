<?php

namespace App\Http\Controllers;

use App\ClassificationSurgery;
use App\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;
Use App\TypeSurgery;



class TypeSurgerysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classification = ClassificationSurgery::get();

        return view('dashboard.director.surgery', compact('classification'));
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

        $data =  $request->validate([
            'name'   => 'required',
            'duration' => 'required',
            'cost'   => 'required',
            'description' => 'required',
            'classification_surgery_id' => 'required',
            'cost.required' => 'Es obligatorio precio de la cirugía.',
        ]);

        $surgery =  TypeSurgery::create([
            'name'                        => $data['name'],
            'duration'                    => $data['duration'],
            'cost'                        => $data['cost'],
            'description'                 => $data['description'],
            'classification_surgery_id'   => $request->classification_surgery_id,
            'branch_id'                   => 1
        ]);

        return redirect()->back()->withSuccess('Registro agregado correctamente');
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

    public function surgeries(Request $request){  //lista de todas las cirugias
        $s = TypeSurgery::get();

        if(!is_null($s)){
            return response()->json([
                'surgeries' => $s,
            ]);
        }
    }

    public function type_surgery()
    {
        $s = ClassificationSurgery::get();

        if(!is_null($s)){
            return response()->json([
                'tpesurgeries' => $s,
            ]);
        }
    }

    public function procedure_surgery(Request $request) //procedimientos pertenecientes a cierta cirugia
    {
        $e = Surgery::with('procedure')->where('id', $request->id)->first();

        if(!is_null($e)){
            return response()->json([
                'details' => $e,
            ]);
        }
    }

    // public function surgeries_patient(Request $request){
    //     //$s = TypeSurgery::get();
    //     $p = Patient::where('id', $request->id)->first();

    //     if(!is_null($p)){
    //         return response()->json([
    //             'posible_surgeries' => $p,
    //         ]);
    //     }
    // }
}

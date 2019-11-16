<?php

namespace App\Http\Controllers\API;

use App\ClassificationSurgery;
use App\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;
Use App\TypeSurgery;
Use App\Surgery;


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
        //
    }

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
        $e = Surgery::with('procedures')->where('id', $request->id)->first();

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

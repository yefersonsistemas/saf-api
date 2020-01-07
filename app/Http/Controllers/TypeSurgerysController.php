<?php

namespace App\Http\Controllers;

use App\ClassificationSurgery;
use App\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Procedure;
Use App\Typesurgery;



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
        $procedure = Procedure::get();

        return view('dashboard.director.surgery', compact('classification', 'procedure'));
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
            'day_hospitalization' => 'required',
            'cost.required' => 'Es obligatorio precio de la cirugía.',
        ]);

        $surgery =  Typesurgery::create([
            'name'                        => $data['name'],
            'duration'                    => $data['duration'],
            'cost'                        => $data['cost'],
            'description'                 => $data['description'],
            'classification_surgery_id'   => $request->classification_surgery_id,
            'day_hospitalization'         => $request->day_hospitalization,
            'branch_id'                   => 1
        ]);

        if (!is_null($surgery)) {
            if (!empty($request->procedure)) {
                foreach ($request->procedure as $procedure) {
                    $procedimiento = Procedure::find($procedure);
                    $surgery->procedure()->attach($procedimiento); 
                }
            }
        }

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
        // dd($id);
        $classification = ClassificationSurgery::get();
        $procedure = Procedure::get();
        $surgery = Typesurgery::with('procedure', 'classification')->find($id);
        // dd($surgery);

        return view('dashboard.director.surgery-edit', compact('classification', 'procedure', 'surgery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $surgery = Typesurgery::with('classification', 'procedure')->find($request->id);

        $surgery->name = $request->name;
        $surgery->duration = $request->duration;
        $surgery->cost = $request->cost;
        $surgery->description = $request->description;
        $surgery->classification_surgery_id = $request->classification_surgery_id;
        $surgery->day_hospitalization =  $request->day_hospitalization;
        $surgery->update();

        $surgery->procedure()->sync($request->procedure);

        return redirect()->route('all.register')->withSuccess('Registro modificado');

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

    /**
     * tipo de cirugía
     */

    public function create_classification()
    {
        return view('dashboard.director.type-surgery');
    }


    public function store_classification(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $person = ClassificationSurgery::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'branch_id' => 1
        ]);

        return redirect()->route('all.register')->withSuccess('Registro agregado correctamente');
    }
}

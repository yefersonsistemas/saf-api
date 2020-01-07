<?php

namespace App\Http\Controllers;

use App\TypeArea;
use App\Image;
use App\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreasController extends Controller
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
        $type = TypeArea::get();
        return view('dashboard.director.area', compact('type'));
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
        $data = $request->validate([
            'name' => 'required',
            'type_area_id' => 'required'
        
        ]);

        $area = Area::create([
            'name' => $data['name'],
            'type_area_id' => $request->type_area_id,
            'branch_id' => 1
        ]);

        if($request->type_area_id == 3){
            $todas_areas = Area::where('type_area_id',$request->type_area_id)->get();
            dd($todas_areas);
        }

        $image = $request->file('image');
        $path = $image->store('public/Areas');  
        $path = str_replace('public/', '', $path);
        $image = new Image;
        $image->path = $path;
        $image->imageable_type = "App\Area";
        $image->imageable_id = $area->id;
        $image->branch_id = 1;
        $image->save();

        return redirect()->back()->withSuccess('Registro creado correctamente');
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
        $area = Area::with('image', 'typearea')->find($id);
        $type = TypeArea::get();
        $b_area = array($area->typearea);
        $diff = $type->diff($b_area);

        return view('dashboard.director.area-edit', compact('type', 'area', 'diff'));
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
        dd($request);
        $area = Area::with('image', 'typearea')->find($request->id);
        dd($area);
        $type = TypeArea::get();

        $area->name = $request->name;
        $area->type_area_id = $request->type_area_id;
        $area->save();


        if ($request->image != null) {
            $image = $request->file('image');
            $path = $image->store('public/Areas');  
            $path = str_replace('public/', '', $path);
            $image = new Image;
            $image->path = $path;
            $image->imageable_type = "App\Area";
            $image->imageable_id = $area->id;
            $image->branch_id = 1;
            $image->save();
        }
           
        return redirect()->route('all.register')->withSuccess('Registro modificado');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($area)
    {
        $area = Area::find($area);
        // dd($area);
        $area->delete();
        return redirect()->route('all.register')->withSuccess('Registro eliminado');
    }

    public function list_area(){
        $a = Area::all();

        return response()->json([
            'area' => $a,
        ]);
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeArea;
use App\Image;

class TypeAreasController extends Controller
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
        return view('dashboard.director.type-area');
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
            'name' => 'required',
            'description' => 'required',
           
        ]);

        $type = TypeArea::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'branch_id' => 1
        ]);

        $image = $request->file('image');
        $path = $image->store('public/TypeAreas');  
        $path = str_replace('public/', '', $path);
        $image = new Image;
        $image->path = $path;
        $image->imageable_type = "App\TypeArea";
        $image->imageable_id = $type->id;
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
        $type = TypeArea::find($id);
        return view('dashboard.director.type-area-edit', compact('type'));
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
        $type = TypeArea::find($request->id);

        $type->name = $request->name;
        $type->description = $request->description;
        $type->update();

        if ($request->image != null) {
            $image = $request->file('image');
            $path = $image->store('public/TypeAreas');  
            $path = str_replace('public/', '', $path);
            $image = new Image;
            $image->path = $path;
            $image->imageable_type = "App\TypeArea";
            $image->imageable_id = $type->id;
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
    public function destroy(TypeArea $type)
    {
        $type = TypeArea::find($type);
        $type->delete();
        return redirect()->route('all.register')->withSuccess('Registro eliminado');
    }

}

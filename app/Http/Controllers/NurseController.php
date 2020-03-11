<?php

namespace App\Http\Controllers;

use App\File;
use App\Informesurgery;
use App\Patient;
use App\Person;
use App\Reservation;
use App\Surgery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\FileAnestesiologo;
use App\FileDoctor;
use App\FileInternista;
use App\Typesurgery;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surgeries = Surgery::whereDate('date', Carbon::now()->format('Y-m-d'))->orderBy('date', 'asc')->with('patient.person.image', 'employe.person','typesurgeries','area')->get();
        // dd( $surgeries);

        return  view('dashboard.vergel.enfermeria.lista_cirugias', compact('surgeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $surgery)
    {
        // dd($id, $surgery);

        $patient = Patient::with('person')->find($id);
        // dd($patient);
        $surgery = Surgery::with('file_internista')->where('patient_id',  $patient->id)->find($surgery);
        // dd($surgery->file_internista);

        $internista = FileInternista::where('fileable_id', $surgery->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        // dd($internista);

        $anestesiologo = FileAnestesiologo::where('fileable_id', $surgery->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
        // dd($anestesiologo->first());
        $cirujano = FileDoctor::where('fileable_id', $surgery->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();

        return view('dashboard.vergel.enfermeria.create-informe-cirugia', compact('patient', 'surgery', 'internista', 'anestesiologo', 'cirujano'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $surgery, $id)
    {
        // dd($id);
        $surgery = Surgery::with('typesurgeries')->find($surgery);
            // dd($surgery);

        if($id == 1){
            
            if($request->file('file')){
                
                $image = $request->file('file');
                $path = $image->store('public/Internista');
                $path = str_replace('public/', '', $path);
                $image = new FileInternista;
                $image->path = $path;
                $image->fileable_type = "App\Surgery";
                $image->fileable_id = $surgery->id;
                $image->branch_id = 1;
                $image->save();
       
                // dd($image);
                return response()->json(["status" => "success", "data" => $image]);
            }
        }

        
        if($id == 2){
            
            if($request->file('file')){
                
                $image = $request->file('file');
                $path = $image->store('public/Anestesiologo');
                $path = str_replace('public/', '', $path);
                $image = new FileAnestesiologo();
                $image->path = $path;
                $image->fileable_type = "App\Surgery";
                $image->fileable_id = $surgery->id;
                $image->branch_id = 1;
                $image->save();
       
                // dd($image);
                return response()->json(["status" => "success", "data" => $image]);
            }
        }

        
        if($id == 3){
            
            if($request->file('file')){
                
                $image = $request->file('file');
                $path = $image->store('public/Cirujano');
                $path = str_replace('public/', '', $path);
                $image = new FileDoctor();
                $image->path = $path;
                $image->fileable_type = "App\Surgery";
                $image->fileable_id = $surgery->id;
                $image->branch_id = 1;
                $image->save();
       
                // dd($image);
                return response()->json(["status" => "success", "data" => $image]);
            }
        }

        $cirugia1 = Informesurgery::where('surgery_id', $surgery->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->first();
        // dd($surgery->id);

        if($cirugia1 == null){
            $cirugia = Informesurgery::create([
                'surgery_id' =>  $surgery->id,
                'status' => true,
                'fecha_ingreso' => Carbon::now(),
                'fecha_culminar' => Carbon::now()->addDays($surgery->typesurgeries->day_hospitalization),
                'branch_id' => 1
            ]);
        }
            
        
        
    //  dd( $cirugia);

        return redirect()->route('lista_cirugias')->withSuccess('Informe guardado correctamente');
    }

    //=============================Eliminar dropzone=========================
    public function eliminarD(Request $request)
    {
        $datos=json_decode($request->filename);
        $id= $datos->data->id;
        $image = FileDoctor::find($id);
        $image->delete();
        return $image;
    }

    //=============================Eliminar dropzone=========================
    public function eliminarI(Request $request)
    {
        // dd($request);
        $datos=json_decode($request->filename);
        $id= $datos->data->id;
        $image = FileInternista::find($id);
        $image->delete();
        return $image;
    }

    //=============================Eliminar dropzone=========================
    public function eliminarA(Request $request)
    {
        $datos=json_decode($request->filename);
        $id= $datos->data->id;
        $image = FileAnestesiologo::find($id);
        $image->delete();
        return $image;
    }

     //=============================Eliminar dropzone=========================
     public function eliminarG(Request $request)
     {
        //  dd($request);

        if($request->tipo == 1){
            $image = FileInternista::find($request->filename);
            $image->delete();
           return $image;
        }

        if($request->tipo == 2){
            $image = FileAnestesiologo::find($request->filename);
            $image->delete();
           return $image;
        }

        if($request->tipo == 3){
            $image = FileDoctor::find($request->filename);
            $image->delete();
           return $image;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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

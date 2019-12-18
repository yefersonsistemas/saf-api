<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
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
        return view('dashboard.director.exam');
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
        ]);

        $exam = Exam::create([
            'name'  => $data['name'],
            'branch_id' => 1,
        ]);

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
        $exam = Exam::find($id);

        return view('dashboard.director.exam-edit', compact('exam'));
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
        $exam = Exam::find($request->id);

        $exam->name = $request->name;
        $exam->update();

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

    public function exams(Request $request)
    {
        $patient = Patient::with('diagnostic.exam')->where('person_id', $request->person_id)->first();

        // $exam = Exam::get();
        // //dd($patient);
        // $pdf = PDF::loadView('pdf.exam', compact('exam')); //vista generada por el componente PDF
        //             //carpeta.namearchivo
        return response()->json([
            // 'Exams' => $pdf->download('exam.pdf'), 
            'exams' => $patient,
        ]);
    }

}

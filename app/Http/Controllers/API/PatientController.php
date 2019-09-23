<?php

namespace App\Http\Controllers\API;

//use App\Allergy;
//use App\Disease;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
//use App\Medicine;
//use App\Patient;
//use App\User;
//use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function index(Request $request)
  {
    //
  }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create(Request $request)
 {
  //
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(CreatePatientRequest $request)
 {
    // 
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Patient  $patient
  * @return \Illuminate\Http\Response
  */
 public function show(Patient $patient)
 {
  //
}

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Patient  $patient
  * @return \Illuminate\Http\Response
  */
 public function edit(Patient $patient)
 {
  //
}

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Patient  $patient
  * @return \Illuminate\Http\Response
  */
 public function update(UpdatePatientRequest $request, Patient $patient)
 {
  // 
 }
 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Patient  $patient
  * @return \Illuminate\Http\Response
  */
 public function destroy(Patient $patient)
 {
  //
 }
  /*  public function pdfPatient(Request $request,Patient $patient){
        $description = $request->description;
        $description2 = $request->description2;
        $view = \View::make("dashboard.patients.pdfPatient", compact('patient','description','description2'))->render();          
        $pdf = \App::make('dompdf.wrapper')->setPaper('letter', 'landscape');
        $pdf->loadHTML($view);
        return $pdf->stream();
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
    }
    public function recipe(Patient $patient){
        return view('dashboard.patients.recipe', compact('patient'));
    }*/
}

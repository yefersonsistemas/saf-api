<?php

namespace App\Http\Controllers\API;

use App\Allergy;
use App\Disease;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Medicine;
use App\Patient;
use App\Person;
use App\Reservation;
use App\Employe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    $patients = Patient::all();
      
    return response()->json([
      'patients' => $patients,
    ]);

    // $patients = Patient::with('diagnostics')->byDni($request->s)->byName($request->s)->latest()->paginate(20);
    // //return view('dashboard.patients.index', compact('patients'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $users       = User::all();
    $diseases    = Disease::all();
    $medicines   = Medicine::all();
    $patient    = Patient::all()->last();
    if ($patient == null) {
      $number = 1;
    } else {
      $number = $patient->id + 1;
    }

    if (strlen($number) == 1) {
      $history_number = 'P-000' . $number;
    } elseif (strlen($number) == 2) {
      $history_number = 'P-00' . $number;
    } elseif (strlen($number) == 3) {
      $history_number = 'P-0' . $number;
    } else {
      $history_number = 'P-' . $number;
    }

    //   dd(($history_number));

    $doctors     = User::role('doctor')->get();
    $professions = [
      'Cocinero', 'Secretario', 'Programador', 'Fotógrafo', 'Mecánico/a', 'Abogado/a', 'Periodista', 'Ama de casa', 'Peluquero/a', 'Ingeniero/a', 'Electricista', 'Economista', 'Médico/a', 'Dentista', 'Consultor', 'Albañil', 'Panadero', 'Arquitecto', 'Actor', 'Contable', 'Modelo', 'Monja', 'Enfermero/a', 'Oficinista', 'Conserje', 'Político', 'Vendedor', ' Militar', 'Deportista', 'Cirujano', 'Veterinario', 'Profesor/a', 'Taxista',
    ];

    //return view('dashboard.patients.create', compact('professions', 'doctors', 'medicines', 'diseases', 'users', 'history_number'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreatePatientRequest $request)
  {
    // dd($request);
    $data      = $request->validated();
    $date      = Carbon::parse($data['date']);
    $birthdate = date("Y-m-d", strtotime($data['birthdate']));
    $patient   = Patient::create([
      'date'             => $date,
      'history_number'   => $data['history_number'],
      'reason'           => $data['reason'],
      'name'             => $data['name'],
      'lastname'         => $data['lastname'],
      'email'            => $data['email'],
      'another_email'    => $request->another_email,
      'type_dni'         => $request->type_dni,
      'dni'              => $data['dni'],
      'gender'           => $data['gender'],
      'phone'            => $data['phone'],
      'another_phone'    => $request->another_phone,
      'place'            => $data['place'],
      'birthdate'        => $birthdate,
      'age'              => $data['age'],
      'weight'           => $data['weight'],
      'occupation'       => $data['occupation'],
      'address'          => $data['address'],
      'doctor_id'        => $request->medico,
      'previous_surgery' => $request->previous_surgery,
      'profession'       => $data["profession"][0],
    ]);
    if ($request->allergy) {
      $nuevo = Allergy::create([
        'name' => $request->allergy,
      ]);
      $patient->allergies()->attach($nuevo->id);
    }
    if ($request->diseases) {
      foreach ($request->diseases as $disease) {
        $newDisease = Disease::firstOrCreate([
          'name' => $disease,
        ]);
        $patient->diseases()->attach($newDisease->id);
      }
    }
    if ($request->medicines) {
      foreach ($request->medicines as $medicine) {
        $newMedicine = Medicine::firstOrcreate([
          'name' => $medicine,
        ]);
        $patient->medicines()->attach($newMedicine->id);
      }
    }
    //return redirect()->route('patients.index')->withSuccess('Paciente registrado exitosamente');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function show(Patient $patient)
  {
    $speciality = $patient->specialities;
    $doct       = $patient->doctor->first();
    $medicines  = $patient->medicines;
    $diseases   = $patient->diseases;
    $allergy    = $patient->allergies->first();
    if ($allergy) {
      $allergy = $allergy->name;
    }
    $patient->load('diagnostics.doctor');
    $diagnosticos = $patient->diagnostics;
    foreach ($diagnosticos as $diagnostico) {
      $doctor_diag[] = $diagnostico->doctor;
    }
    //return view('dashboard.patients.show', compact('doctor_diag', 'allergy', 'doct', 'patient', 'speciality', 'diagnosticos', 'diseases', 'medicines'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function edit(Patient $patient)
  {
    $users       = User::all();
    $doct        = $patient->doctor;
    $doctors     = User::role('doctor')->where("id", "!=", $patient->doctor_id)->get();
    $birthdate   = Carbon::parse($patient->birthdate)->format('Y-m-d');
    $prof        = $patient->profession;
    $professions = [
      'Cocinero', 'Secretario', 'Programador', 'Fotógrafo', 'Mecánico/a', 'Abogado/a', 'Periodista', 'Ama de casa', 'Peluquero/a', 'Ingeniero/a', 'Electricista', 'Economista', 'Médico/a', 'Dentista', 'Consultor', 'Albañil', 'Panadero', 'Arquitecto', 'Actor', 'Contable', 'Modelo', 'Monja', 'Enfermero/a', 'Oficinista', 'Conserje', 'Político', 'Vendedor', ' Militar', 'Deportista', 'Cirujano', 'Veterinario', 'Profesor/a', 'Taxista',
    ];
    $allergy   = $patient->allergies->first();
    $diseases  = Disease::all();
    $ds        = $patient->diseases;
    $medicines = Medicine::all();
    $md        = $patient->medicines;
    $i         = 0;
    $x         = 0;
    if ($allergy) {
      $allergy = $allergy->name;
    }
    foreach ($diseases as $key2) {
      foreach ($ds as $key) {
        if ($key->name == $key2->name) {
          $diseases->pull($i);
          $diseases->all();
        }
      }
      $i++;
    }
    foreach ($medicines as $key2) {
      foreach ($md as $key) {
        if ($key->name == $key2->name) {
          $medicines->pull($x);
          $medicines->all();
        }
      }
      $x++;
    }
    // return view('dashboard.patients.edit', compact('birthdate', 'doctors', 'doct', 'patient', 'professions', 'medicines', 'users', 'diseases', 'ds', 'md', 'prof', 'allergy'));
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
    // dd($request);
    $data      = $request->validated();
    $birthdate = Carbon::parse($data['birthdate'])->format('Y-m-d');
    $date      = Carbon::parse($data['date'])->format('Y-m-d');
    $patient->date             = $date;
    $patient->history_number   = $data['history_number'];
    $patient->reason = $data['reason'];
    $patient->name             = $data['name'];
    $patient->lastname         = $data['lastname'];
    $patient->type_dni         = $request->type_dni;
    $patient->dni              = $data["dni"];
    $patient->email            = $data["email"];
    $patient->another_email    = $request->another_email;
    $patient->phone            = $data["phone"];
    $patient->another_phone    = $request->another_phone;
    $patient->age              = $data["age"];
    $patient->weight           = $data["weight"];
    $patient->gender           = $data["gender"];
    $patient->place            = $data["place"];
    $patient->birthdate        = $birthdate;
    $patient->occupation       = $data["occupation"];
    $patient->address          = $data["address"];
    $patient->doctor_id        = $request->medico[0];
    $patient->previous_surgery = $request->previous_surgery;
    $patient->profession       = $data["profession"][0];
    $diseases                  = $patient->diseases;
    $medicines                 = $patient->medicines;
    $patient->save();
    $allergy = $patient->allergies->first();
    if ($request->allergy) {
      if (!$allergy) {
        $allergy_id = 0;
      } else {
        $allergy_id = $allergy->id;
      }
      $nuevo = Allergy::updateOrCreate(
        ['id' => $allergy_id],
        ['name' => $request->allergy]
      );
      if (!$allergy_id) {
        $patient->allergies()->attach($nuevo->id);
      }
    }

    if ($diseases) {
      foreach ($diseases as $key) {
        $patient->diseases()->detach($key->id);
      }
    }

    if ($request->disease) {
      foreach ($request->disease as $disease) {
        $newDisease = Disease::firstOrCreate([
          'name' => $disease,
        ]);
        $patient->diseases()->attach($newDisease->id);
      }
    }
    if ($medicines) {
      foreach ($medicines as $key) {
        $patient->medicines()->detach($key->id);
      }
    }

    if ($request->medicine) {
      foreach ($request->medicine as $medicine) {
        $newMedicine = Medicine::firstOrcreate([
          'name' => $medicine,
        ]);
        $patient->medicines()->attach($newMedicine->id);
      }
    }
    // return redirect()->route('patients.show', $patient);
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
  public function pdfPatient(Request $request, Patient $patient)
  {
    $description = $request->description;
    $description2 = $request->description2;
    $view = \View::make("dashboard.patients.pdfPatient", compact('patient', 'description', 'description2'))->render();
    $pdf = \App::make('dompdf.wrapper')->setPaper('letter', 'landscape');
    $pdf->loadHTML($view);
    return $pdf->stream();
    // $pdf = PDF::loadView('pdf.invoice', $data);
    // return $pdf->download('invoice.pdf');
  }

  public function recipe(Patient $patient)
  {
    // return view('dashboard.patients.recipe', compact('patient'));
  }

  public function record_cite(Request $request){
  //$cite = Reservation::with('patient.diagnostic')->where('patient_id', $request->patient_id)->get();
  $cite = Patient::with('reservation','diagnostic')->where('id', $request->id)->first();
  
      return response()->json([
        'Patient' => $cite,
      ]);

  }
  
}

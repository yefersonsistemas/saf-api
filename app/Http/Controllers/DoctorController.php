<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\Medicine;
use App\Exam;
use App\Diagnostic;
use App\Procedure;
use App\Surgery;
use Carbon\Carbon;
use App\Http\Requests\CreateDiagnosticRequest;
use App\Employe;
use App\Billing;
use App\Reservation;
use App\Person;
use Illuminate\Support\Facades\Auth;
use App\Doctor;
use App\Speciality;

class DoctorController extends Controller
{

 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
       $patients = Reservation::with('patient.historyPatient')->where('person_id',$id )
                                ->whereDate('date', Carbon::now()->format('Y-m-d'))->get();
                                // dd($patients);
                                // dd($patients);

        // if (!is_null($patients)) {
        //     return response()->json([
        //         'reservas' => $patients,
        //     ]);
        // }

       
      return view('dashboard.doctor.citasPacientes',compact('patients'));
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
    public function show($id )
    {

        $history=Reservation::with('patient.historyPatient')->where('id',$id)
        ->whereDate('date', Carbon::now()->format('Y-m-d'))->first();
        // dd($history);
        return view('dashboard.doctor.historiaPaciente', compact('history'));
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

    public function crearDiagnostico(){
        return view('dashboard.doctor.crearDiagnostico');
    }

    public function crearRecipe(){
        return view('dashboard.doctor.crearRecipe');
    }
    public function crearReferencia(){
        return view('dashboard.doctor.crearReferencia');
    }

    

    public function searchDoctor(Request $request)
    {
        $doctors = Speciality::with('employe.person', 'employe.image')->where('id', $request->id)->get();

        if (!is_null($doctors->first()->employe)) {
            return $doctors;
        }else{
            return response()->json([
                202,
                'message' => 'sin medicos',
            ]);
        }
    }

    /**
     * 
     * Busca el horario del doctor y 
     * retorna los dias que el tenga disponible
     * 
     */
    public function search_schedule(Request $request){//busca el horario del medico para agendar cita
        $employe = Employe::with('schedule')->where('id', $request->id)->first();

        if (!is_null($employe)) {
            if (!is_null($employe->schedule)) {
                foreach ($employe->schedule as $schedule) {
                    $date[]  = new Carbon('next ' . $schedule->day);
                    $quota[] = $schedule->quota;
                }

                for ($i = 0; $i < count($date); $i++) {
                    /**
                     * El 12 del ciclo for j,
                     * hace referencia a 12 semanas que es la mayor 
                     * anticipacion a la q se puede tener una cita
                     */
                    for ($j= 0; $j < 12; $j++) { 
                        $citesToday = Reservation::whereDate('date', $date[$i])->where('approved', '!=', null)->get()->count();
                        if ($citesToday < $quota[$i]) {
                            $available[] = array(Carbon::create($date[$i]->year, $date[$i]->month, $date[$i]->day)); 
                        }
                        $date[$i] = $date[$i]->addWeek();
                    }
                }

                for ($i=0; $i < count($available) ; $i++) { 
                    $availables[$i] = $available[$i][0];
                }

                return response()->json([
                    'employe'       => $employe,
                    'available'     => $availables,
                ]);
            }else{
                return response()->json([
                    'message' => 'Medico sin horario',
                ]);
            }
        }else{
            return response()->json([
                'message' => 'Medico no encontrado',
            ]);
        }
    }
}

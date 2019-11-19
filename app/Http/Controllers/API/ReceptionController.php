<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use Carbon\Carbon;
Use App\Patient;
Use App\Person;
Use App\Surgery;
use App\Cite;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdateStatusCiteRequest;


class ReceptionController extends Controller
{

    public function index() //sirve mas para la App
    {
        $reservations = Reservation::with('person')->whereDate('date', Carbon::now()->format('Y-m-d'))
                        ->get(); //mostrar las reservaciones solo del dia

        if (!empty($reservations)) {
            $reservations = $reservations->each(function( $reservation){
                $patient = Person::where('id', $reservation->patient_id)->first();
                if ($patient != null) {
                    $reservation->patient = $patient;
                    return $reservation; 
                }
            });
            return response()->json([
                'reservations' => $reservations,
            ]);
        }
    }

    public function list_reception(){  //para la vista de reception
        $rs = Reservation::with('speciality', 'person','patient.historyPatient','patient.inputoutput')
                         ->whereDate('date', Carbon::now()->format('Y-m-d'))->get();

                return response()->json([
                    'reservations' => $rs,
                ]);
    }

    public function cite_patient(Request $request){ //envia los datos de la cita por paciente cuando se va a generar la historia
        $r = Reservation::with('speciality','person')->where('patient_id', $request->patient_id)->whereDate('date', Carbon::now()->format('Y-m-d'))->first();

        if (!empty($r)) {

            $patient = Person::where('id', $r->patient_id)->first();
            if ($patient != null) {
                $r->patient = $patient;
                return $r; 
            }
           
            return response()->json([
                'Reservation' => $r,
            ]);
        }
    }

    public function search(Request $request)
    {
        $person = Person::where('dni', $request->dni)->first(); //busco a ver si existe la persona

        if (!is_null($person)) {  //si existe

            return response()->json([
                'person' => $person,
            ]);
        }
    }

    public function search_P(Request $request)
    {
        $patient = Patient::where('person_id', $request->person_id)->first(); //busca paciente para ver si ya tiene historia

        if (!is_null($patient)) { 

            return response()->json([
                'patient' => $patient,
            ]);
        }
    }

    public function generate_number()
    {
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

        return $history_number;
    }

    public function create_history(CreatePatientRequest $request)
    {

        $history_number = $this->generate_number();

        $patient = Patient::create([  
            'date'               => $request['date'],
            'history_number'     => $history_number,
            'reason'             => $request['reason'],
            'person_id'          => $request['person_id'],
            'gender'             => $request['gender'],
            'place'              => $request['place'],
            'birthdate'          => $request['birthdate'],
            'age'                => $request['age'],
            'weight'             => $request['weight'],
            'occupation'         => $request['occupation'],
            'profession'         => $request['profession'],
            'previous_surgery'   => $request['provious_surgery'],
            'employe_id'         => $request['employe_id'],
            'another_phone'      => $request['another_phone'],
            'another_email'      => $request['another_email'],
            'branch_id'          => 1
        ]);

        return response()->json([
            'message' => 'Paciente creado exitosamente',
        ]);
        
    }

    public function reason(Request $request){  //motivo de cancelar o suspender la cita
        $data = $request->validate([
            'reservation_id' => 'required',
            'reason'  => 'required',
        ]);

        $cites = Cite::create([
            'reservation_id' => $data['reservation_id'],
            'reason' => $data['reason'],
            'branch_id' => 1
        ]);

        // return response()->json([
        //     'message' => 'Registro creado',
        // ]);
    }

    public function cancel(Request $request){
      
        $reservation = Reservation::find($request->id);
        
        if (!empty($reservation)) {
              $reservation->cancel = 'Cancelado';
      
              if ($reservation->save()){
                  $this->reason($request);
                  return response()->json([
                      'message' => 'Cita cancelada', 
                  ]);
              }
        }else{
            return response()->json([
                'message' => 'Ha ocurrido un error', 
            ]);
        }
    }

    public function discontinued(Request $request){ //fecha limite
      
        $reservation = Reservation::find($request->id);
        
        if (!empty($reservation)) {
          
            $reservation->discontinued = 'Suspendido';
    
            if ($reservation->save()){
                $this->reason($request);
                return response()->json([
                    'message' => 'Cita suspendida', 
                ]);
            }
        }else{
            return response()->json([
                'message' => 'No se pudo suspender la cita',
            ]);
        }
    }

    public function approved(Request $request){
      
        $reservation = Reservation::find($request->id);
        
        if (!empty($reservation)) {
          
            $reservation->approved = 'Aprobado';
    
            if ($reservation->save()){
               return response()->json([
                    'message' => 'Confirmada', 
                ]);
            }
        }else{
            return response()->json([
                'message' => 'No se pudo confirmar la cita',
            ]);
        }
    }

    public function list_S(Request $request)
    {
        $cites = Reservation::with('person', 'patient', 'cite')->where('discontinued', 'Suspendido')->get();

        if (!is_null($cites)) {
            
            return response()->json([
                'discontinued' => $cites, 

            ]);
        }else{
            return response()->json([
                'message' => 'No hay citas suspendidas',
            ]);
        }
    }

    public function list_C()
    {
        $cites = Reservation::with('person', 'patient', 'cite')->where('cancel', 'Cancelado')->get();

        if (!empty($cites)) {
            return response()->json([
                'cancel' => $cites, 
            ]);
        }else{
            return response()->json([
                'message' => 'No hay citas canceladas',
            ]);
        }
    }

    public function delete_cite(Request $request) //eliminar de lista suspendidas
    {
        $r = Reservation::where('id', $request->id)->first();
        $cite = Cite::where('reservation_id', $request->id)->first();

          if(!is_null($cite) && !is_null($r)){
           $cite->delete();
           $r->delete();
 
                return response()->json([
                'message' => 'Cita eliminada',
                ]);
            }
    }
    
    public function list_R() //lista de reservaciones en GENERAL
    {
        $rs = Reservation::with('speciality','person')->get();

        if (!empty($rs)) {
            
            $rs = $rs->map(function( $r){
                $patient = Person::where('id', $r->patient_id)->first();
                if ($r != null && $patient != null) {
                    $r->patient->image;
                    $r->patient->person;
                    return $r; 
                }
            });
            return response()->json([
                'all' => $rs,
            ]);
        }
    }
}

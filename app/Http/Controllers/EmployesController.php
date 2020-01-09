<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Employe;
use App\Person;
use Illuminate\Http\Request;
use App\Patient;
use App\Position;
use App\Reservation;
Use App\Visitor;
use App\Billing;
use App\Assistance;
use App\AreaAssigment;
use App\Image;
use App\User;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::whereDate('date', Carbon::now()->format('Y-m-d'))->get();
        $employes = Employe::get();
        //dd($employes);
        $days = array('lunes', 'martes', 'miercoles', 'jueves', 'viernes');

        $e = $employes->each( function ($employe) {
            if ($employe->position->name == 'doctor') {
                $dia = Carbon::now()->dayOfWeek;
                $employe->schedule->contains($dia);
                return $employe;
            }
        });

        if ($e->isNotEmpty()) {
            foreach ($e as $person) {
                Visitor::create([
                    'person_id' => $person->person_id,
                    'type_visitor' => 'Empleado',
                    'inside'    => null,
                    'outside'   => null,
                    'branch_id' => 1
                    ]);
                }
            }
            
        $employes = Visitor::with('person.employe.position')->whereDate('created_at', Carbon::now()->format('Y-m-d'))
                            ->where('type_visitor', 'Empleado')->get();

        return response()->json([
            'employes' => $employes,
        ]);
    }

    public function all_doctors() //muestra todos los medicos registrados en el sistema
    {
        $employes = Employe::with('image','person.user', 'position')->get();
        $em = collect([]);
        
        if ($employes->isNotEmpty()) {
            foreach($employes as $employe){
                if ($employe->position->name == 'doctor' && $employe->person->user->role('doctor')) {
                    $em->push($employe);
                }
            }

            return response()->json([
                'doctors' => $em,
            ]);
        }
    } 

    public function assistance(Request $request) //control de asistencia del medico de los dias q no asiste
    {     
        if($request->motivo != null){
            $date = Carbon::now()->format('Y-m-d');

            $asistencia = Assistance::where('employe_id', $request->employe_id)
                                ->whereDate('created_at', $date)->get();

            if ($asistencia->isEmpty()) {
                Assistance::create([
                    'employe_id' => $request->employe_id,
                    'status' => $request->motivo,
                    'branch_id' => 1
                ]);

                Alert::success('Asistencia medica cancelada exitosamente');
                return redirect()->back();
            
            }else{
                Alert::error('Ya ha sido registrado como inasistente');
                return redirect()->back();
            }
        }else{
            Alert::error('Debe ingresar el motivo de inasistencia');
            return redirect()->back();
        }
    }

    //======================== Medicos del dia ===========================
    public function doctor_on_day()
    {
        // dd($id);
        $employes = Employe::with('image','person.user', 'speciality', 'assistance', 'schedule','areaassigment.area')->get();
        $a = AreaAssigment::first();
        // dd($employes);
        $em = collect([]);
        if ($employes->isNotEmpty()) {
            foreach ($employes as $employe) {
                if ($employe->person->user->role('doctor') && $employe->position->name == 'doctor') {
                    if ($employe->schedule->isNotEmpty()) {
                        $dia = strtolower(Carbon::now()->locale('en')->dayName);
                        foreach ($employe->schedule as $schedule) {
                            if ($schedule->day == $dia) {
                                $em->push($employe);
                            }
                        }
                    }
                    
                }
            }
        }

         return view('dashboard.checkin.doctor', compact('em'));
    }

    public function doctor_on_todos()//todos los medicos
    {
 
        $employes = Employe::with('image','person.user', 'speciality', 'assistance', 'schedule')->get();
   
        $e = collect([]);
        if ($employes->isNotEmpty()) {
            foreach($employes as $employe){
                if ($employe->position->name == 'doctor' && $employe->person->user->role('doctor')) {
                    $e->push($employe);
                }
            }
            }
            return view('dashboard.checkin.doctor_todos', compact('e'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        // dd($permission);

        $position = Position::all();
        return view('dashboard.director.createE', compact('position', 'permissions'));
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
            'type_dni'  => 'required',
            'dni'   => 'required',
            'lastname' => 'required',
            'phone'     => 'required',
            'email' =>  'required',
            'address'   => 'required',
            'position_id'   => 'required',
        ]);

        $person = Person::create([
            'name' => $data['name'],
            'type_dni'  => $data['type_dni'],
            'dni'   => $data['dni'],
            'lastname' => $data['lastname'],
            'phone'     => $data['phone'],
            'email' =>  $data['email'],
            'address'   => $data['address'],
            'branch_id' => 1
        ]);

        $employe = Employe::create([
            'person_id' => $person->id,
            'position_id'   =>$request->position_id,
            'branch_id' => 1
        ]);

        // dd($person);
        if ($request->pass == 'option1') {
            $user = User::create([
                'email'      => $person->email,
                'password'   => encrypt($request->password),
                'person_id'  => $person->id,
                'branch_id' => 1
                ]);

            foreach ($request->perms as  $permission){
            $user->givePermissionTo([$permission]);
            }
        }
        
        if ($request->image != null) {
            $image = $request->file('image');
            $path = $image->store('public/employes');  //cambiar el nombre de carpeta cuando se tenga el cargo a que pertenece
            $path = str_replace('public/', '', $path);
            $image = new Image;
            $image->path = $path;
            $image->imageable_type = "App\Employe";
            $image->imageable_id = $employe->id;
            $image->branch_id = 1;
            $image->save();
        }

        return redirect()->route('employe.index');
    }

    public function positions()
    {
        $positions = Position::all();
        return response()->json([
            'positions' => $positions,
        ]);
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
        $employe = Employe::with('person.user', 'position', 'image')->find($id);
        $position = Position::all();

        $buscar_P = Position::where('id', $employe->position->id)->first(); 
        $posi = array($buscar_P);
        $diff = $position->diff($posi);

        return view('dashboard.director.employe-edit', compact('employe','position', 'buscar_P', 'diff'));
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
        // dd($request);
        // dd($request->image);
        $employe = Employe::with('person.user', 'position', 'image')->find($request->id);
        
        $employe->person->type_dni = $request->type_dni;
        $employe->person->dni = $request->dni;
        $employe->person->name = $request->name;
        $employe->person->lastname = $request->lastname;
        $employe->person->address = $request->address;
        $employe->person->phone = $request->phone;
        $employe->person->email = $request->email;
        $employe->update();

       if ($request->image != null) {
           
           $image = $request->file('image');
           $path = $image->store('public/employes');  
           $path = str_replace('public/', '', $path);
           $image = new Image;
           $image->path = $path;
           $image->imageable_type = "App\Employe";
           $image->imageable_id = $employe->id;
           $image->branch_id = 1;
           $image->save();
        }

       return redirect()->route('employe.index')->withSuccess('Registro modificado'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = Employe::find($id);
        $employe->delete();
        return redirect()->route('employe.index')->withSuccess('Eliminado correctamente');
    }

    public function statusIn(Request $request){
        
        $visitor = Visitor::where('person_id', $request->id)->first();
    
        if (!empty($visitor)) {
            $visitor->type_visitor = 'Empleado';
            $visitor->inside = Carbon::now();

            if ($visitor->save()){
                // event(new Security($visitor)); //envia el aviso a recepcion de que el paciente citado llego 
                return response()->json([
                    'message' => 'Empleado dentro de las instalaciones', 
                ]);
            }else{
                return response()->json([
                    'message' => 'No guardo', 
                ]);
            }
        }else{
            return response()->json([
                'message' => 'No actualizo', 
            ]);
        }
    }

    public function diagnostic(CreateDiagnosticRequest $request){

        $diagnostic = Diagnostic::create([
            'patient_id' => $request['patient_id'],
            'description' => $request['description'],
            'reason' => $request['reason'],
            'treatment' => $request['treatment'],
            'annex' => $request['annex'],
            'next_cite' => $request['next_cite'],
            'employe_id' => $request['employe_id'],
            'branch_id'  => 1,
        ]);

            return response()->json([
                'message' => 'diagnostico agregado',
                'diagnostic' => $diagnostic,
            ]);
    }

    // public function recipe(Request $request){
       
    //     $medicines = Medicine::all();  //suponiendo q esten cargadas se seleccionara las q necesitan 
        
    //     return response()->json([
    //         'medicines' => $medicines,
    //     ]);
    // }

    public function list()
    {
        $doctor = Employe::with('person.user','procedures')->get();

        $doctors = $doctor->each(function ($doctor)
        {
            $doctor->person->user->role('doctor');
            return $doctor;
        });

        return response()->json([
            'doctors' => $doctors,
        ]);
    }

    //falta acomodar el rango de las fechas
    public function calculo_week(Request $request){  //clase A fija su precio para las consultas
        $employe = Employe::with('person.user', 'doctor.typedoctor')->where('person_id', $request->person_id)->first();

        if ($employe->position->name != 'doctor' || !$employe->person->user->role('doctor')) {
            return response()->json([
                'message' => 'empleado no es medico',
            ]);
        }

        $inicio = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $fin = Carbon::now()->endOfWeek(Carbon::FRIDAY);

        $billing = Billing::with('procedures')->where('employe_id', $employe->id)->whereBetween('created_at', [$inicio , $fin])->get();

        $total = 0;
        foreach($billing as $b){
            foreach ($b->procedures as $procedure) {
                $total += $procedure->price;
            }
        }

        $pago = (($employe->doctor->typedoctor->comission * $employe->doctor->price) + $total);
        return response()->json([
            'pago' => $pago,
        ]);
    }
    
    public function record_patient(Request $request){  //todos los pacientes por doctor
        $employe = Employe::with('person.user', 'patient.person')->where('id', $request->id)->first();

        if (!is_null($employe)) {
            return response()->json([
                'patients' => $employe,
            ]);
        }
    } 

    public function patient_on_day(Request $request){  //pacientes del dia por doctor
        $patients = Reservation::with('patient')->where('person_id', $request->person_id)
                                ->whereDate('date', Carbon::now()->format('Y-m-d'))->get();

        if (!is_null($patients)) {
            return response()->json([
                'reservas' => $patients,
            ]);
        }
    }

    public function detail_doctor(Request $request){
        $doctor = Employe::with('person.user', 'image')->where('id', $request->id)->first();

        if (!is_null($doctor)) {
            if ($doctor->person->user->role('doctor')) {
                return response()->json([
                    'doctor' => $doctor,
                ]);   
            }
        }
    }
}

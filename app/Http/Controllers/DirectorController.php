<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;                               
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Allergy;
use App\Area;
use App\AreaAssigment;
use App\Disease;
use App\Doctor;
use App\Person;
use App\Employe;
use App\Exam;
use App\Position;
use App\Speciality;
use App\Image;
use App\Medicine;
use App\TypePayment;
use App\Procedure;
use App\Service;
use App\TypeArea;
use App\TypeDoctor;
use App\Typesurgery;
use App\User;
use App\ClassificationSurgery;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employe::with('person', 'position', 'speciality')->get();

        return view('dashboard.director.index', compact('employes'));
    }

    public function exporEmploye(){}

    /**
     * lista los visitantes  o acompañentes
     */
    public function visitantes(){  
        $patients = Patient::with('person')->get();
        $employes = Employe::with('person')->get();
        $persons = Person::get();

        foreach($patients as $item){   //busca  las personas que estan en pacientes
            foreach($persons as $person){
                    if($person == $item->person){
                        $encontrado[] = $person;
                    }               
                }   
        }

        foreach($employes as $item){  //busca  las personas que estan en empleados
            foreach($persons as $person){
                    if($person == $item->person){
                        $encontrado2[] = $person;
                    }               
                }   
        }

        $all = $persons->diff($encontrado);  //tiene aquellos que no estan en pacientes
        $all2 = $all->diff($encontrado2);   //tiene los encontrados en pacientes y empleados y muestra el total de los q no estan
        // dd($all2);
        $visitors = $all2->count();   //contador total en la vista de visitantes

        return view('dashboard.director.visitors', compact('all2', 'visitors'));
    }

    public function exporVisitante(){}


    public function all_register()
    {
       $positions = Position::get();
    //    dd($positions);
       $services = Service::get();
       $specialitys = Speciality::get();
    //    dd($specialitys);
       $procedures = Procedure::with('speciality')->get();
    //    dd($procedures);
   
       $surgerys = Typesurgery::with('classification')->get();
       $allergys = Allergy::get();
       $diseases = Disease::get();
       $medicines = Medicine::get();
       $exams = Exam::get();
       $types = TypeArea::get();
       $areas = Area::with('typearea')->get();
    //    dd($areas);
       $clases = TypeDoctor::get();
       $doctors = Doctor::with('typeDoctor')->get();
    //    dd($doctors);
       $payments = TypePayment::get();
       $classifications = ClassificationSurgery::get();

       return view('dashboard.director.all', compact('positions', 'services', 'specialitys', 'procedures', 'surgerys', 'allergys', 'diseases', 'medicines', 'exams', 
                                                     'types', 'areas', 'clases', 'doctors', 'payments', 'classifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = Position::where('name', 'doctor')->first();
        // dd( $position);
        $speciality = Speciality::all();
        $procedure = Procedure::get();
        $clases = TypeDoctor::get();
        $permissions = Permission::all();
        $type = TypeArea::where('name', 'Consultorio')->first();
        // dd($type);
        $area = Area::with('areaassigment.employe')->where('type_area_id', $type->id)->get();
        // dd($area);

        return view('dashboard.director.created', compact('position', 'speciality', 'procedure', 'clases', 'permissions', 'area'));
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
        // dd($person);

        $employe = Employe::create([
            'person_id' => $person->id,
            'position_id'   =>$request->position_id,
            'branch_id' => 1
        ]);
        // dd($employe);
            
        $user = User::create([
            'email'      => $person->email,
            'password'   => Hash::make($request->contra),
            'person_id'  => $person->id,
            'branch_id' => 1
        ]);
        // dd($user);

        $cargo = Position::find($request->position_id);
        // dd($cargo);

        $user->assignRole($cargo->name);

        foreach ($request->perms as  $permission){
        $user->givePermissionTo([$permission]);
        }

        if (!is_null($employe)) { 
            if (!empty($request->speciality)) {
                foreach ($request->speciality as $speciality) {
                    $especialidad = Speciality::find($speciality);
                    $employe->speciality()->attach($especialidad); 
                    }
            }
        }
         
        if (!is_null($employe)) {
            if (!empty($request->procedure)) {
                foreach ($request->procedure as $procedure) {
                    $procedimiento = Procedure::find($procedure);
                    $employe->procedures()->attach($procedimiento); 
                }
            }
        }

        if ($request->area_id != null) {
           
            $area = AreaAssigment::create([
                'employe_id' => $employe->id,
                'area_id'    => $request->area_id,
                'branch_id' => 1
            ]);
        }

        // dd($area);
    
          
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

        return redirect()->route('employe.index')->withSuccess($cargo->name.' '.'registrado');
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
     *
     * modifica medico
     */
    public function edit($id)
    {
        $employe = Employe::with('person.user', 'position','speciality', 'image','procedures')->find($id);
        $position = Position::where('name', 'doctor')->first();
        $speciality = Speciality::get();
        $procedure = Procedure::get();
        $clases = TypeDoctor::get();
        $precio = Doctor::where('employe_id', $employe->id)->first();

        $permissions = Permission::all();
        $perms = $employe->person->user->permissions;

        $buscar_C = TypeDoctor::where('id', $precio->type_doctor_id)->first();
        $clase = array($buscar_C);
        $diff_C = $clases->diff($clase);

        $diff_E = $speciality->diff($employe->speciality);
        $diff_P = $procedure->diff($employe->procedures);

        return view('dashboard.director.doctor-edit', compact('employe','position', 'clases', 'precio', 'diff_E', 'diff_P', 'diff_C', 'buscar_C', 'permissions','perms'));
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
        //  dd($request);
        
        $employe = Employe::with('person.user', 'position','speciality', 'image')->find($id);
        $user = User::where('person_id', $employe->person->id )->first();
        $doctor = Doctor::where('employe_id', $employe->id)->first();
       
        $employe->person->type_dni = $request->type_dni;
        $employe->person->dni = $request->dni;
        $employe->person->name = $request->name;
        $employe->person->lastname = $request->lastname;
        $employe->person->address = $request->address;
        $employe->person->phone = $request->phone;
        $employe->person->email = $request->email;
        
        $employe->speciality()->sync($request->speciality);
        $employe->procedures()->sync($request->procedure); 

        $doctor->price = $request->price;
        $doctor->type_doctor_id = $request->type_doctor_id;
        
        $employe->update();
        $doctor->save();

        $user->permissions()->sync($request->perms);
        if ($request->image != null) {
            if ( $employe->image == null) {
               
                $image = $request->file('image');
                $path = $image->store('public/employes');  
                $path = str_replace('public/', '', $path);
                $image = new Image;
                $image->path = $path;
                $image->imageable_type = "App\Employe";
                $image->imageable_id = $employe->id;
                $image->branch_id = 1;
                $image->save();
            }else{
                // dd($employe->image->path);
                Storage::disk('public')->delete($employe->image->path); //elimina la img de storage para generar la nueva
                

                $image = $request->file('image');
                $path = $image->store('public/employes');  
                $path = str_replace('public/', '', $path);
                $employe->image->path = $path;
                $employe->image->save();
            }
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
        //
    }

     /*
    *  crea el precio de la consulta por doctor
    */
    public function create_price()
    {
        $employes = Employe::with('person.user', 'position')->get();
        $clases = TypeDoctor::all();

        return view('dashboard.director.price', compact('employes', 'clases'));
    }

    public function store_price(Request $request)
    {
        // dd($request);
        
        $data = $request->validate([
            'employe_id' => 'required',
            'type_doctor_id'  => 'required',
            'price'   => 'required',
        ]);

        $doctor = Doctor::create([
            'employe_id' => $request->employe_id,
            'type_doctor_id'  => $request->type_doctor_id,
            'price'   => $data['price'],
            'branch_id' => 1
        ]);

        return redirect()->back()->withSuccess('Registro creado correctamente');
    }

    public function edit_price($id)
    {
        // dd($id);
        $precio = Doctor::find($id);
    //    dd($precio);
        $employes = Employe::with('person.user', 'position', 'doctor')->where('id',$precio->employe_id)->first();
        // dd($employes);
        $clases = TypeDoctor::get();
        //dd($clases);

        return view('dashboard.director.price-edit', compact('employes', 'clases', 'precio'));
    }

    public function update_price(Request $request)
    {
    //    dd($request);
        
        $precio = Doctor::find($request->id);
        $employes = Employe::with('person.user', 'position', 'doctor')->get();
        $clase = TypeDoctor::all();

        $precio->price = $request->price;
        $precio->type_doctor_id = $request->type_doctor_id;
        $precio->update();

        return redirect()->route('all.register')->withSuccess('Registro modificado');
    }

    public function destroy_consulta($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('all.register')->withSuccess('Registro eliminado');
    }

    
}

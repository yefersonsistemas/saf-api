<?php

use App\Diagnostic;
use App\Disease;
use App\Employe;
use Illuminate\Database\Seeder;
use App\User;
use App\Person;
use App\Position;
use App\Patient;
use App\Reservation;
use App\Schedule;
use App\Speciality;
//use App\Procedure;
use App\Traits\ImageFactory;
use App\Treatment;

class UsersTableSeeder extends Seeder
{
    use ImageFactory;

    public function run()
    {
        Person::truncate();
        Position::truncate();
        Employe::truncate();
        User::truncate();
        Schedule::truncate();
        Patient::truncate();
        Diagnostic::truncate();
        $this->deleteDirectory(storage_path('/app/public/employes'));
        $this->deleteDirectory(storage_path('/app/public/patient'));
        Reservation::truncate();
        //Procedure::truncate();

        /**
         * Crea un doctor
         * junto a sus pacientes, citas, diagnosticos
         * horarios, especialidad, cargo, usuario
         */

        /**
         * Persona que sera el medico
         */
        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345679',
            'name' => 'NATALIA',
            'lastname' => 'NEIRA',
            'address' => 'la mata',
            'phone' => '(594) 466-3902 x409',
            'email' => 'dranatalianeira@sinusandface.com',
            'branch_id' => '1',
        ]);

        /**
         * Cargo para los medicos
         */
        $position = factory(App\Position::class)->create([
            'name' => 'doctor',
        ]);

        /**
         * Se registra el medico
         * creado en la tabla empleado
         */
        $employe = factory(App\Employe::class)->create([
            'person_id' => $person->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe->id, 'App\Employe');

        /**
         * Especialidades para el medico
         * y sus procedimientos
         */
        $num = rand(1,3);
        for ($i=0; $i < $num ; $i++) { 
            $speciality = Speciality::inRandomOrder()->first();
            $speciality->employe()->attach($employe->id);
            foreach ($speciality->procedures as $procedure) {
                $procedure->employe()->attach($employe->id);
            }
        }

        /**
         * se crea el usuario
         * del empleado
         */
        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver lista de pacientes')
            ->givePermissionTo('crear historia de paciente')
            ->givePermissionTo('crear diagnostico')
            ->givePermissionTo('elegir examenes a realizar')
            ->givePermissionTo('elegir procedimientos a realizar')
            ->givePermissionTo('crear recipe')
            ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

        /**
         * Se crea el horario del medico
         */
        $schedule = factory(Schedule::class, rand(1,3))->create([
            'employe_id' => $employe->id
        ]);

        /**
         * Personas que seran los pacientes
         */
        $persons = factory(Person::class, 5)->create()->each(function ($person) use ($employe) {
            /**
             * Registro de la historia medica
             * con su fotografia
             */
            $patient = factory(App\Patient::class)->create([
                'person_id' => $person->id,
                'employe_id' => $employe->id
            ]);
            $this->to('patient', $patient->id, 'App\Patient');
                
            /**
             * Enfermedades del paciente
             */
            for ($i=0; $i < rand(1,5) ; $i++) { 
                $disease = Disease::inRandomOrder()->first();
                $disease->patient()->attach($patient->id);
            }

            /**
             * Tratamiento para el paciente
             * y su daignostico
             */
            $treatment = Treatment::inRandomOrder()->first();
            factory(App\Diagnostic::class)->create([
                'employe_id' => $employe->id,
                'patient_id' => $patient->id,
                'treatment_id' => $treatment->id
            ]);

            /**
             * Registro de la reservacion
             */
            factory(App\Reservation::class)->create([
                'patient_id'     => $patient->id,
                'person_id'      => $employe->id,
                'schedule_id'    => $employe->schedule->first()->id,
                'specialitie_id' => $employe->speciality->first()->id,
            ]);
        });


        /**
         * Registro de 10 usuarios medicos de 
         * manera automatica se crean primero 
         * las 10 personas que seran los medicos
         */
        factory(Person::class, 10)->create()->each(function ($person) use ($position) {
            /**
             * Por cada persona se
             * registra en la tabla de los
             * empleados, con su imagen
             */
            $employe = factory(App\Employe::class)->create([
                'person_id' => $person->id,
                'position_id' => $position->id
            ]);
            $this->to('employes', $employe->id, 'App\Employe');

            /**
             * Especialidades para el medico
             * y sus procedimientos
             */
            $num = rand(1,3);
            for ($i=0; $i < $num ; $i++) { 
                $speciality = Speciality::inRandomOrder()->first();
                $speciality->employe()->attach($employe->id);
                foreach ($speciality->procedures as $procedure) {
                    $procedure->employe()->attach($employe->id);
                }
            }

            /**
             * se crea el usuario
             * del empleado
             */
            factory(User::class)->create([
                'person_id' => $person->id,
            ])->givePermissionTo('ver lista de pacientes')
                ->givePermissionTo('crear historia de paciente')
                ->givePermissionTo('crear diagnostico')
                ->givePermissionTo('elegir examenes a realizar')
                ->givePermissionTo('elegir procedimientos a realizar')
                ->givePermissionTo('crear recipe')
                ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

            /**
             * Se crea el horario del medico
             */
            $schedule = factory(Schedule::class, rand(1,3))->create([
                'employe_id' => $employe->id
            ]);

            /**
             * Personas que seran los pacientes
             */
            $persons = factory(Person::class, 5)->create()->each(function ($person) use ($employe) {
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe->id
                ]);
                $this->to('patient', $patient->id, 'App\Patient');
                    
                /**
                 * Enfermedades del paciente
                 */
                for ($i=0; $i < rand(1,5) ; $i++) { 
                    $disease = Disease::inRandomOrder()->first();
                    $disease->patient()->attach($patient->id);
                }

                /**
                 * Tratamiento para el paciente
                 * y su diagnostico
                 */
                $treatment = Treatment::inRandomOrder()->first();
                factory(App\Diagnostic::class)->create([
                    'employe_id'    => $employe->id,
                    'patient_id'    => $patient->id,
                    'treatment_id'  => $treatment->id
                ]);

                /**
                 * Registro de la reservacion
                 */
                factory(App\Reservation::class)->create([
                    'patient_id'     => $patient->id,
                    'person_id'      => $employe->id,
                    'schedule_id'    => $employe->schedule->first()->id,
                    'specialitie_id' => $employe->speciality->first()->id,
                ]);
            });
        });





        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345678',
            'name' => 'JOSE PASTOR',
            'lastname' => 'LINAREZ',
            'address' => 'la mora',
            'phone' => '(594) 466-3901 x408',
            'email' => 'drjoselinarez@sinusandface.com',
            'branch_id' => '1',
        ]);

        $position = factory(App\Position::class)->create([
            'name' => 'seguridad',
        ]);

        $employe = factory(App\Employe::class)->create([
            'person_id' => $person->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe->id, 'App\Employe');

        factory(User::class)->create([
            'person_id' => $person->id,
        ])->givePermissionTo('Registrar visitantes')
            ->givePermissionTo('Ver lista de visitantes')->assignRole('seguridad');


        factory(Person::class, 2)->create()->each(function ($person) use ($position) {
            factory(App\Employe::class)->create([
                'person_id' => $person->id,
                'position_id' => $position->id
            ]);
            factory(App\User::class)->create([
                'person_id' => $person->id
            ])->assignRole('seguridad');
        });

        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345675',
            'name' => 'ANDERLIN',
            'lastname' => 'RODRIGUEZ',
            'address' => 'los pinos',
            'phone' => '294-887-95415 x861',
            'email' => 'recepcion@sinusandface.com',
            'branch_id' => '1',
        ]);

        $position = factory(App\Position::class)->create([
            'name' => 'recepcion',
        ]);

        $employe = factory(App\Employe::class)->create([
            'person_id' => $person->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe->id, 'App\Employe');

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver lista de pacientes')
            ->givePermissionTo('crear historia de paciente')
            ->givePermissionTo('crear cita')->assignRole('recepcion');


        factory(Person::class, 2)->create()->each(function ($person) use ($position) {
            factory(App\Employe::class)->create([
                'person_id' => $person->id,
                'position_id' => $position->id
            ]);
            factory(App\User::class)->create([
                'person_id' => $person->id
            ])->assignRole('recepcion');
        });

        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345672',
            'name' => 'ANA KARINA',
            'lastname' => 'COLOMBO',
            'address' => 'centro',
            'phone' => '863-247-0437 x789',
            'email' => 'asistente1@sinusandface.com',
            'branch_id' => '1',
        ]);


        $position = factory(App\Position::class)->create([
            'name' => 'IN',
        ]);

        $employe = factory(App\Employe::class)->create([
            'person_id' => $person->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe->id, 'App\Employe');

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver lista de pacientes')
        ->givePermissionTo('crear historia de paciente')
        ->givePermissionTo('asignar consultorio')->assignRole('IN');


        factory(Person::class, 2)->create()->each(function ($person) use ($position) {
            factory(App\Employe::class)->create([
                'person_id' => $person->id,
                'position_id' => $position->id
            ]);
            factory(App\User::class)->create([
                'person_id' => $person->id
            ])->assignRole('IN');
        });

        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345673',
            'name' => 'LIDIA',
            'lastname' => 'COLOMBO',
            'address' => 'pedro leon torres',
            'phone' => '(793) 696-4038 x1936',
            'email' => 'asistente2@sinusandface.com',
            'branch_id' => '1',
        ]);


        $position = factory(App\Position::class)->create([
            'name' => 'OUT',
        ]);

        $employe = factory(App\Employe::class)->create([
            'person_id' => $person->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe->id, 'App\Employe');

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('crear factura')
            ->givePermissionTo('crear recipe')
            ->givePermissionTo('crear diagnostico')
            ->givePermissionTo('Recibir notificacion de paciente candidato a cirugia')->assignRole('OUT');


        factory(Person::class, 2)->create()->each(function ($person) use ($position) {
            factory(App\Employe::class)->create([
                'person_id' => $person->id,
                'position_id' => $position->id
            ]);
            factory(App\User::class)->create([
                'person_id' => $person->id
            ])->assignRole('OUT');
        });

        // $position = factory(App\Position::class)->create([
        //     'name' => 'logistica',
        // ]);

        // $employe = factory(App\Employe::class)->create([
        //     'person_id' => $person->id,
        //     'position_id' => $position->id
        // ]);
        // $this->to('employes', $employe->id, 'App\Employe');

        // factory(User::class)->create([
        //     'person_id' => $person->id,

        // ])->givePermissionTo('ver insumo')
        //     ->givePermissionTo('registrar insumo')
        //     ->givePermissionTo('modificar insumo')
        //     ->givePermissionTo('eliminar insumo')
        //     ->givePermissionTo('asignar insumo')
        //     ->givePermissionTo('ver equipo')
        //     ->givePermissionTo('registrar equipo')
        //     ->givePermissionTo('modificar equipo')
        //     ->givePermissionTo('eliminar equipo')
        //     ->givePermissionTo('asignar equipo')
        //     ->givePermissionTo('ver inventario')
        //     ->givePermissionTo('ver inventario por area')
        //     ->givePermissionTo('Registrar limpieza')
        //     ->givePermissionTo('ver registro de limpieza')
        //     ->givePermissionTo('Crear reporte')->assignRole('logistica');


        // $person = Person::create([
        //     'type_dni' => 'V',
        //     'dni' => '12345670',
        //     'name' => 'KENWHERLY',
        //     'lastname' => 'HERNANDEZ',
        //     'address' => 'Las velas',
        //     'phone' => '292-717-70415 x861',
        //     'email' => 'kenwherly@sinusandface.com',
        //     'branch_id' => '1',
        // ]);


        // $employe = factory(App\Employe::class)->create([
        //     'person_id' => $person->id,
        //     'position_id' => $position->id
        // ]);
        // $this->to('employes', $employe->id, 'App\Employe');

        // factory(User::class)->create([
        //     'person_id' => $person->id,
        // ])->givePermissionTo('ver insumo')
        //     ->givePermissionTo('registrar insumo')
        //     ->givePermissionTo('modificar insumo')
        //     ->givePermissionTo('eliminar insumo')
        //     ->givePermissionTo('asignar insumo')
        //     ->givePermissionTo('ver equipo')
        //     ->givePermissionTo('registrar equipo')
        //     ->givePermissionTo('modificar equipo')
        //     ->givePermissionTo('eliminar equipo')
        //     ->givePermissionTo('asignar equipo')
        //     ->givePermissionTo('ver inventario')
        //     ->givePermissionTo('ver inventario por area')
        //     ->givePermissionTo('Registrar limpieza')
        //     ->givePermissionTo('ver registro de limpieza')
        //     ->givePermissionTo('Crear reporte')->assignRole('logistica');


        // factory(Person::class, 5)->create()->each(function ($person) use ($position) {
        //     factory(App\Employe::class)->create([
        //         'person_id' => $person->id,
        //         'position_id' => $position->id
        //     ]);
        //     factory(App\User::class)->create([
        //         'person_id' => $person->id
        //     ])->assignRole('logistica');
        // });

        // $person = Person::create([
        //     'type_dni' => 'V',
        //     'dni' => '12345674',
        //     'name' => 'MARIA ELENA',
        //     'lastname' => 'RIVERO',
        //     'address' => 'el recreo',
        //     'phone' => '294-887-9515 x862',
        //     'email' => 'administracion1@sinusandface.com',
        //     'branch_id' => '1',
        // ]);

        // $position = factory(App\Position::class)->create([
        //     'name' => 'administracion',
        // ]);

        // $employe = factory(App\Employe::class)->create([
        //     'person_id' => $person->id,
        //     'position_id' => $position->id
        // ]);
        // $this->to('employes', $employe->id, 'App\Employe');

        // factory(User::class)->create([
        //     'person_id' => $person->id,

        // ])->givePermissionTo('ver cuentas por pagar')
        //     ->givePermissionTo('ver cuentas por cobrar')
        //     ->givePermissionTo('Crear reporte')->assignRole('administracion');


        // factory(Person::class, 5)->create()->each(function ($person) use ($position) {
        //     $employe = factory(App\Employe::class)->create([
        //         'person_id' => $person->id,
        //         'position_id' => $position->id
        //     ]);
        //     $this->to('employes', $employe->id, 'App\Employe');

        //     factory(App\User::class)->create([
        //         'person_id' => $person->id
        //     ])->assignRole('administracion');
        // });

        // factory(App\Position::class)->create([
        //     'name' => 'mantenimiento',
        // ]);
        
    }
}

/**
 * Datos de usuarios anteriores,
 * por si se necesitan mas adelante
 */

 // $person = Person::create([
    //     'type_dni' => 'V',
    //     'dni' => '12345671',
    //     'name' => 'GABRIELA',
    //     'lastname' => 'LINAREZ',
    //     'address' => 'agua viva',
    //     'phone' => '1-735-709-8377 x0026',
    //     'email' => 'dragabrielalinarez@sinusandface.com',
    //     'branch_id' => '1',
    // ]);

    // $employe = factory(App\Employe::class)->create([
    //     'person_id' => $person->id,
    //     'position_id' => $position->id
    // ]);
    // $this->to('employes', $employe->id, 'App\Employe');

    // factory(User::class)->create([
    //     'person_id' => $person->id,

    // ])->givePermissionTo('ver lista de pacientes')
    //     ->givePermissionTo('crear historia de paciente')
    //     ->givePermissionTo('crear diagnostico')
    //     ->givePermissionTo('elegir examenes a realizar')
    //     ->givePermissionTo('elegir procedimientos a realizar')
    //     ->givePermissionTo('crear recipe')
    //     ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

    // $schedule = factory(App\Schedule::class)->create([
    //     'employe_id' => $employe->id
    // ]);

    // $service = factory(App\Service::class)->create();

    // $speciality = factory(App\Speciality::class)->create([
    //     'service_id' => $service->id
    // ]);

    // $persons = factory(Person::class)->create();

    // $patient = factory(App\Patient::class)->create([
    //     'person_id' => $persons->id,
    //     'employe_id' => $employe->id
    // ]);
    // $this->to('patient', $patient->id, 'App\Patient');

    // $treatment = factory(App\Treatment::class)->create();
    // factory(App\Diagnostic::class)->create([
    //     'employe_id' => $employe->id,
    //     'patient_id' => $patient->id,
    //     'treatment_id' => $treatment->id
    // ]);

    // factory(App\Reservation::class)->create([
    //     'patient_id' => $patient->id,
    //     'person_id' => $person->id,
    //     'schedule_id' => $schedule->id,
    //     'specialitie_id' => $speciality
    // ]);

    // $person = Person::create([
    //     'type_dni' => 'V',
    //     'dni' => '12345677',
    //     'name' => 'HEMBERTH ALEJANDRO',
    //     'lastname' => 'MEDINA',
    //     'address' => 'libertador',
    //     'phone' => '191-780-95415 x861',
    //     'email' => 'medina@sinusandface.com',
    //     'branch_id' => '1',
    // ]);

    // $employe = factory(App\Employe::class)->create([
    //     'person_id' => $person->id,
    //     'position_id' => $position->id
    // ]);
    // $this->to('employes', $employe->id, 'App\Employe');

    // factory(User::class)->create([
    //     'person_id' => $person->id,

    // ])->givePermissionTo('ver lista de pacientes')
    //     ->givePermissionTo('crear historia de paciente')
    //     ->givePermissionTo('crear diagnostico')
    //     ->givePermissionTo('elegir examenes a realizar')
    //     ->givePermissionTo('elegir procedimientos a realizar')
    //     ->givePermissionTo('crear recipe')
    //     ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

    // $schedule = factory(App\Schedule::class)->create([
    //     'employe_id' => $employe->id
    // ]);

    // $service = factory(App\Service::class)->create();

    // $speciality = factory(App\Speciality::class)->create([
    //     'service_id' => $service->id
    // ]);

    // $persons = factory(Person::class)->create();

    // $patient = factory(App\Patient::class)->create([
    //     'person_id' => $persons->id,
    //     'employe_id' => $employe->id
    // ]);
    // $this->to('patient', $patient->id, 'App\Patient');

    // $treatment = factory(App\Treatment::class)->create();
    // factory(App\Diagnostic::class)->create([
    //     'employe_id' => $employe->id,
    //     'patient_id' => $patient->id,
    //     'treatment_id' => $treatment->id
    // ]);

    // factory(App\Reservation::class)->create([
    //     'patient_id' => $patient->id,
    //     'person_id' => $person->id,
    //     'schedule_id' => $schedule->id,
    //     'specialitie_id' => $speciality
    // ]);
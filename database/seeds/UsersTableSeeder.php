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
use App\Medicine;
use App\TypeDoctor;
use App\Doctor;
use App\Typesurgery;
use App\Procedure;
use App\ClassificationSurgery;
use App\TypeEquipment;



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
        TypeDoctor::truncate();
        Doctor::truncate();
        Reservation::truncate();
        Typesurgery::truncate();
        Procedure::truncate();
        ClassificationSurgery::truncate();
        TypeEquipment::truncate();
        $this->deleteDirectory(storage_path('/app/public/employes'));
        $this->deleteDirectory(storage_path('/app/public/patient'));
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
            'type_dni' => 'N',
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
         * clase de medico
         * 
         */

        $type = factory(App\TypeDoctor::class)->create([
            'name' => 'Clase A',
        ]);
        $clase = factory(App\Doctor::class)->create([
            'employe_id' => $employe->id,
            'type_doctor_id' => $type->id,
            'price' => 50000,
            'branch_id' => '1',
        ]);

        $clasificacion = factory(App\ClassificationSurgery::class)->create([
            'name' => 'hospitalaria',
            'description' => 'con hospitalizacion',
            'branch_id' => '1',
        ]);


        //creando cirugia
        $cirugia = factory(App\Typesurgery::class)->create([
            'name' => 'Endoscópica SENOS PARANASALES',
            'duration' => 3,
            'cost' => 77258.00,
            'description' => 'Es un procedimiento para abrir
                            los pasajes de la nariz y los senos paranasales. Se realiza para tratar infecciones de los
                            senos a largo plazo (crónicas).',
            'classification_surgery_id' => $clasificacion->id,
            'branch_id' => '1',
        ]);

        //creando especialidad
        $especialidad = factory(App\Speciality::class)->create([
            'name' => 'Otorrinolaringología',
            'description' => 'Médico entrenado en el manejo y tratamiento,
                            tanto médico como quirúrgico, de pacientes con enfermedades y alteraciones
                            del oído, nariz, garganta y estructuras relacionadas de la cabeza y del cuello.',
            'service_id' => 3,
            'branch_id' => '1',
        ]);

        //relacion de especialidad con el medico
        $especialidad->employe()->attach($employe->id);

        //creando procedimiento
        $procedimiento = factory(App\Procedure::class)->create([
            'name' => 'Septoplastia endoscópica',
            'description' => 'La septoplastía es uno de los procedimientos quirúrgicos 
                                más frecuentes en otorrinolaringología, cuya principal
                                indicación es la presencia de desviación septal nasal 
                                significativa',
            'price' => 2500,
            'speciality_id' => $especialidad->id,
            'branch_id' => '1',
        ]);

        //relacion de la cirugia con el procedimiento
        $cirugia->procedure()->attach($procedimiento);

          //creando procedimiento
          $procedimiento2 = factory(App\Procedure::class)->create([
            'name' => 'Maxiloetmoidectomia bilateral',
            'description' => 'intervención quirúrgica avanzada de abordaje 
                            endoscópico para eliminar bloqueos y tratar infecciones, tumores 
                            benignos y malignos en los senos maxilares y etmoidales, con el 
                            manejo avanzado de la pared lateral nasal se manejan patologías
                            como el papiloma nasal invertido y sinusitis de origen dental que
                            comprometen los senos descritos',
            'price' => 1200,
            'speciality_id' => $especialidad->id,
            'branch_id' => '1',
        ]);

        //relacion de la cirugia con el procedimiento
        $cirugia->procedure()->attach($procedimiento2);

          //creando procedimiento
          $procedimiento3 = factory(App\Procedure::class)->create([
            'name' => 'Uncinectomia bilateral',
            'description' => 'Extracción de la porción media de unciforme',

            'price' => 2500,
            'speciality_id' => $especialidad->id,
            'branch_id' => '1',
        ]);

        //relacion de la cirugia con el procedimiento
        $cirugia->procedure()->attach($procedimiento3);

            //creando procedimiento
            $procedimiento4 = factory(App\Procedure::class)->create([
                'name' => 'Antrostomía bilateral',
                'description' => 'Extracción de la porción media de unciforme.
                ',
                'price' => 2500,
                'speciality_id' => $especialidad->id,
                'branch_id' => '1',
            ]);
    
            //relacion de la cirugia con el procedimiento
            $cirugia->procedure()->attach($procedimiento4);


            $tipo_equipo = factory(App\TypeEquipment::class)->create([
                'name' => 'quirurgico',
                'branch_id' => '1',
            ]);

            //========================= equipos quirurgicos ==========================
            // equipos quirurgicos
            $equipo1 = factory(App\Equipment::class)->create([
                'name' => 'Monitor',
                'description' => 'Extracción de la porción media de unciforme',
    
                'quantity' => 250,
                'type_equipment_id' => $tipo_equipo->id,
                'branch_id' => '1',
            ]);
            $cirugia->equipment()->attach($equipo1);

            // equipos quirurgicos
            $equipo2 = factory(App\Equipment::class)->create([
                'name' => 'Cuchillas mocrodebridador',
                'description' => 'Extracción de la porción media de unciforme',
    
                'quantity' => 250,
                'type_equipment_id' => $tipo_equipo->id,
                'branch_id' => '1',
            ]);
            $cirugia->equipment()->attach($equipo2);

            // equipos quirurgicos
            $equipo3 = factory(App\Equipment::class)->create([
                'name' => 'Mircodebridador y punta de microdebridador',
                'description' => 'Extracción de la porción media de unciforme',
    
                'quantity' => 250,
                'type_equipment_id' => $tipo_equipo->id,
                'branch_id' => '1',
            ]);

            $cirugia->equipment()->attach($equipo3);

              // equipos quirurgicos
              $equipo4 = factory(App\Equipment::class)->create([
                'name' => 'Radiodrecuencia',
                'description' => 'Extracción de la porción media de unciforme',
    
                'quantity' => 250,
                'type_equipment_id' => $tipo_equipo->id,
                'branch_id' => '1',
            ]);
            $cirugia->equipment()->attach($equipo4);


        /**
         * Especialidades para el medico
         * y sus procedimientos
         */
        // $num = rand(1,3);
        // for ($i=0; $i < $num ; $i++) { 
        //     $speciality = Speciality::inRandomOrder()->first();
        //     $speciality->employe()->attach($employe->id);
        //     foreach ($speciality->procedures as $procedure) {
        //         $procedure->employe()->attach($employe->id);
        //     }
        // }

        /**
         * se crea el usuario
         * del empleado
         */
        factory(User::class)->create([
            'email' => 'dranatalianeira@sinusandface.com',
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

        $person = Person::create([
            'type_dni' => 'N',
            'dni' => '14184036',
            'name' => 'MARIA',
            'lastname' => 'SUAREZ',
            'address' => 'la mata',
            'phone' => '04121501501',
            'email' => '    mariaS@gmail.com',
            'branch_id' => '1',
        ]);

            $this->to('person', $person->id, 'App\Person');
            /**
             * Registro de la historia medica
             * con su fotografia
             */
            $patient = factory(App\Patient::class)->create([
                'person_id' => $person->id,
                'employe_id' => $employe->id
            ]);
                
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
            $medicine = factory(App\Medicine::class)->create();
            $treatment = factory(App\Treatment::class)->create([
                'medicine_id' => $medicine->id,
            ]);
            // $treatment = Treatment::inRandomOrder()->first();
            factory(App\Diagnostic::class)->create([
                'employe_id' => $employe->id,
                'patient_id' => $patient->id,
                'treatment_id' => $treatment->id
            ]);

            /**
             * Registro de la reservacion
             */
            factory(App\Reservation::class)->create([
                'patient_id'     => $person->id,
                'person_id'      => $employe->id,
                'schedule_id'    => $employe->schedule->first()->id,
                'specialitie_id' => $employe->speciality->first()->id,
            ]);

            $person = Person::create([
                'type_dni' => 'N',
                'dni' => '14184037',
                'name' => 'CARLOS',
                'lastname' => 'PEREZ',
                'address' => 'la Velas',
                'phone' => '04121501502',
                'email' => 'carlosperez@hotmail.com',
                'branch_id' => '1',
            ]);
    
                $this->to('person', $person->id, 'App\Person');
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(App\Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe->id
                ]);
                    
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
                $medicine = factory(App\Medicine::class)->create();
                $treatment = factory(App\Treatment::class)->create([
                    'medicine_id' => $medicine->id,
                ]);
                // $treatment = Treatment::inRandomOrder()->first();
                factory(App\Diagnostic::class)->create([
                    'employe_id' => $employe->id,
                    'patient_id' => $patient->id,
                    'treatment_id' => $treatment->id
                ]);
    
                /**
                 * Registro de la reservacion
                 */
                factory(App\Reservation::class)->create([
                    'patient_id'     => $person->id,
                    'person_id'      => $employe->id,
                    'schedule_id'    => $employe->schedule->first()->id,
                    'specialitie_id' => $employe->speciality->first()->id,
                ]);

                $person = Person::create([
                    'type_dni' => 'N',
                    'dni' => '14184038',
                    'name' => 'LUPE',
                    'lastname' => 'PARRA',
                    'address' => 'la minta',
                    'phone' => '04121501504',
                    'email' => 'lupeparra@gmail.com',
                    'branch_id' => '1',
                ]);
        
                    $this->to('person', $person->id, 'App\Person');
                    /**
                     * Registro de la historia medica
                     * con su fotografia
                     */
                    $patient = factory(App\Patient::class)->create([
                        'person_id' => $person->id,
                        'employe_id' => $employe->id
                    ]);
                        
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
                    $medicine = factory(App\Medicine::class)->create();
                    $treatment = factory(App\Treatment::class)->create([
                        'medicine_id' => $medicine->id,
                    ]);
                    // $treatment = Treatment::inRandomOrder()->first();
                    factory(App\Diagnostic::class)->create([
                        'employe_id' => $employe->id,
                        'patient_id' => $patient->id,
                        'treatment_id' => $treatment->id
                    ]);
        
                    /**
                     * Registro de la reservacion
                     */
                    factory(App\Reservation::class)->create([
                        'patient_id'     => $person->id,
                        'person_id'      => $employe->id,
                        'schedule_id'    => $employe->schedule->first()->id,
                        'specialitie_id' => $employe->speciality->first()->id,
                    ]);
        

        // $persons = factory(Person::class, 5)->create()->each(function ($person) use ($employe) {
        //     $this->to('person', $person->id, 'App\Person');
        //     /**
        //      * Registro de la historia medica
        //      * con su fotografia
        //      */
        //     $patient = factory(App\Patient::class)->create([
        //         'person_id' => $person->id,
        //         'employe_id' => $employe->id
        //     ]);
                
        //     /**
        //      * Enfermedades del paciente
        //      */
        //     for ($i=0; $i < rand(1,5) ; $i++) { 
        //         $disease = Disease::inRandomOrder()->first();
        //         $disease->patient()->attach($patient->id);
        //     }

        //     /**
        //      * Tratamiento para el paciente
        //      * y su daignostico
        //      */
        //     $medicine = factory(App\Medicine::class)->create();
        //     $treatment = factory(App\Treatment::class)->create([
        //         'medicine_id' => $medicine->id,
        //     ]);
        //     // $treatment = Treatment::inRandomOrder()->first();
        //     factory(App\Diagnostic::class)->create([
        //         'employe_id' => $employe->id,
        //         'patient_id' => $patient->id,
        //         'treatment_id' => $treatment->id
        //     ]);

        //     /**
        //      * Registro de la reservacion
        //      */
        //     factory(App\Reservation::class)->create([
        //         'patient_id'     => $person->id,
        //         'person_id'      => $employe->id,
        //         'schedule_id'    => $employe->schedule->first()->id,
        //         'specialitie_id' => $employe->speciality->first()->id,
        //     ]);
        // });


        /**
         * Registro de 10 usuarios medicos de 
         * manera automatica se crean primero 
         * las 10 personas que seran los medicos
         */
        factory(Person::class, 3)->create()->each(function ($person) use ($position) {
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

            $type = factory(App\TypeDoctor::class)->create([
                'name' => 'Clase B',
            ]);
            $clase = factory(App\Doctor::class)->create([
                'employe_id' => $employe->id,
                'type_doctor_id' => $type->id,
                'price' => 40000
            ]);

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
                'email'     => $person->email,
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
            $persons = factory(Person::class, 3)->create()->each(function ($person) use ($employe) {
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe->id
                ]);
                $this->to('person', $person->id, 'App\Person');
                    
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
                $medicine = factory(App\Medicine::class)->create();
                $treatment = factory(App\Treatment::class)->create([
                    'medicine_id' => $medicine->id,
                ]);
                // $treatment = Treatment::inRandomOrder()->first();
                factory(App\Diagnostic::class)->create([
                    'employe_id'    => $employe->id,
                    'patient_id'    => $patient->id,
                    'treatment_id'  => $treatment->id
                ]);

                /**
                 * Registro de la reservacion
                 */
                factory(App\Reservation::class)->create([
                    'patient_id'     => $person->id,
                    'person_id'      => $employe->id,
                    'schedule_id'    => $employe->schedule->first()->id,
                    'specialitie_id' => $employe->speciality->first()->id,
                ]);
            });
        });

         /**
         * Registro de 10 usuarios medicos de 
         * manera automatica se crean primero 
         * las 10 personas que seran los medicos
         */
        factory(Person::class, 3)->create()->each(function ($person) use ($position) {
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

            $type = factory(App\TypeDoctor::class)->create([
                'name' => 'Clase A',
            ]);
            $clase = factory(App\Doctor::class)->create([
                'employe_id' => $employe->id,
                'type_doctor_id' => $type->id
            ]);

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
                'email'     => $person->email,
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
            $persons = factory(Person::class, 3)->create()->each(function ($person) use ($employe) {
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe->id
                ]);
                $this->to('person', $person->id, 'App\Person');
                    
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
                $medicine = factory(App\Medicine::class)->create();
                $treatment = factory(App\Treatment::class)->create([
                    'medicine_id' => $medicine->id,
                ]);
                // $treatment = Treatment::inRandomOrder()->first();
                factory(App\Diagnostic::class)->create([
                    'employe_id'    => $employe->id,
                    'patient_id'    => $patient->id,
                    'treatment_id'  => $treatment->id
                ]);

                /**
                 * Registro de la reservacion
                 */
                factory(App\Reservation::class)->create([
                    'patient_id'     => $person->id,
                    'person_id'      => $employe->id,
                    'schedule_id'    => $employe->schedule->first()->id,
                    'specialitie_id' => $employe->speciality->first()->id,
                ]);
            });
        });

         /**
         * Registro de 10 usuarios medicos de 
         * manera automatica se crean primero 
         * las 10 personas que seran los medicos
         */
        factory(Person::class, 3)->create()->each(function ($person) use ($position) {
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

            $type = factory(App\TypeDoctor::class)->create([
                'name' => 'Clase C',
            ]);
            $clase = factory(App\Doctor::class)->create([
                'employe_id' => $employe->id,
                'type_doctor_id' => $type->id,
                'price' => 20000
            ]);

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
                'email'     => $person->email,
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
            $persons = factory(Person::class, 3)->create()->each(function ($person) use ($employe) {
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe->id
                ]);
                $this->to('person', $person->id, 'App\Person');
                    
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
                $medicine = factory(App\Medicine::class)->create();
                $treatment = factory(App\Treatment::class)->create([
                    'medicine_id' => $medicine->id,
                ]);
                // $treatment = Treatment::inRandomOrder()->first();
                factory(App\Diagnostic::class)->create([
                    'employe_id'    => $employe->id,
                    'patient_id'    => $patient->id,
                    'treatment_id'  => $treatment->id
                ]);

                /**
                 * Registro de la reservacion
                 */
                factory(App\Reservation::class)->create([
                    'patient_id'     => $person->id,
                    'person_id'      => $employe->id,
                    'schedule_id'    => $employe->schedule->first()->id,
                    'specialitie_id' => $employe->speciality->first()->id,
                ]);
            });
        });


        $person = Person::create([
            'type_dni' => 'N',
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
            'email' => 'drjoselinarez@sinusandface.com',
            'person_id' => $person->id,
        ])->givePermissionTo('Registrar visitantes')
            ->givePermissionTo('Ver lista de visitantes')->assignRole('seguridad');


        factory(Person::class, 2)->create()->each(function ($person) use ($position) {
            factory(App\Employe::class)->create([
                'person_id' => $person->id,
                'position_id' => $position->id
            ]);
            factory(App\User::class)->create([
                'email'     => $person->email,
                'person_id' => $person->id
            ])->assignRole('seguridad');
        });

        $person = Person::create([
            'type_dni' => 'N',
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
            'email' => 'recepcion@sinusandface.com',
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
                'email'     => $person->email,
                'person_id' => $person->id
            ])->assignRole('recepcion');
        });

        $person = Person::create([
            'type_dni' => 'N',
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
            'email' => 'asistente1@sinusandface.com',
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
                'email'     => $person->email,
                'person_id' => $person->id
            ])->assignRole('IN');
        });

        $person = Person::create([
            'type_dni' => 'N',
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
            'email' => 'asistente2@sinusandface.com',
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
            'email' => $person->email,
                'person_id' => $person->id
            ])->assignRole('OUT');
        });

        /* 
         * Crea un usuario
         * con el rol director
         */

        $person = Person::create([
            'type_dni' => 'N',
            'dni' => '10848123',
            'name' => 'JUAN',
            'lastname' => 'CORTEZ',
            'address' => 'el vallecito',
            'phone' => '0412 1501234',
            'email' => 'administrador@sinusandface.com',
            'branch_id' => '1',
        ]);


        $position = factory(App\Position::class)->create([
            'name' => 'director',
        ]);

        $employe = factory(App\Employe::class)->create([
            'person_id' => $person->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe->id, 'App\Employe');

        factory(User::class)->create([
            'email' => 'administrador@sinusandface.com',
            'person_id' => $person->id,

        ])->givePermissionTo('registrar empleado')
        ->givePermissionTo('ver empleados')
        ->givePermissionTo('registrar doctor')
        ->givePermissionTo('registrar especialidad')
        ->assignRole('director');

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
    //$this->to('person', $person->id, 'App\Person');

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
    // $this->to('person', $person->id, 'App\Person');;

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
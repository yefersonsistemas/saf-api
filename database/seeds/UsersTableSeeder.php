<?php

use App\Area;
use App\AreaAssigment;
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
use App\Procedure;
use App\Traits\ImageFactory;
use App\Treatment;
use App\Medicine;
use App\TypeDoctor;
use App\Doctor;
use App\Typesurgery;
use App\ClassificationSurgery;
use App\TypeEquipment;
use App\Sschedule;
use App\TypeArea;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class UsersTableSeeder extends Seeder
{
    use ImageFactory;

    public function run()
    {
        Area::truncate();
        TypeArea::truncate();
        Person::truncate();
        Position::truncate();
        Employe::truncate();
        User::truncate();
        Schedule::truncate();
        Patient::truncate();
        Diagnostic::truncate();
        TypeDoctor::truncate();
        Speciality::truncate();
        Doctor::truncate();
        Reservation::truncate();
        Typesurgery::truncate();
        Procedure::truncate();
        ClassificationSurgery::truncate();
        TypeEquipment::truncate();
        AreaAssigment::truncate();
        $this->deleteDirectory(storage_path('/app/public/employes'));
        $this->deleteDirectory(storage_path('/app/public/patient'));
        $this->deleteDirectory(storage_path('/app/public/typearea'));
        $this->deleteDirectory(storage_path('/app/public/area'));
        $this->deleteDirectory(storage_path('/app/public/surgeries'));

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
            'price' => 70000,
            'branch_id' => '1',
        ]);

        $clasificacion = factory(App\ClassificationSurgery::class)->create([
            'name' => 'hospitalaria',
            'description' => 'con hospitalizacion',
            'branch_id' => '1',
        ]); 

        //================ DAtos para cirugia hospitalaria ================================

        //creando cirugia
        $cirugia = factory(App\Typesurgery::class)->create([
            'name' => 'Endoscópica SENOS PARANASALES',
            'duration' => 3,
            'cost' => 77258.00,
            'description' => 'Es un procedimiento para abrir
                            los pasajes de la nariz y los senos paranasales. Se realiza para tratar infecciones de los
                            senos a largo plazo (crónicas).',
            'day_hospitalization' => '1 dia',
            'classification_surgery_id' => $clasificacion->id,
            'branch_id' => '1',
        ]);
        $cirugia->employe_surgery()->attach($employe->id);
        $this->to('surgeries', $cirugia->id, 'App\Typesurgery');

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

            //procedimiento de consulta
            $pro= factory(Procedure::class)->create([
                'name'    => 'Consulta médica',
                'description' => 'Solo consulta',
                'price' => 5000,
            ]);
            $employe->procedures()->attach($pro);

        //creando procedimiento
        $procedimiento = factory(App\Procedure::class)->create([
            'name' => 'Septoplastia endoscópica',
            'description' => 'La septoplastía es uno de los procedimientos quirúrgicos 
                                más frecuentes en otorrinolaringología, cuya principal
                                indicación es la presencia de desviación septal nasal 
                                significativa',
            'price' => 2500,
            // 'speciality_id' => $especialidad->id,
            'branch_id' => '1',
        ]);

        $procedimiento->speciality()->attach($especialidad);
        //relacion de la cirugia con el procedimiento
        $cirugia->procedure()->attach($procedimiento);

        $employe->procedures()->attach($procedimiento);

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
            // 'speciality_id' => $especialidad->id,
            'branch_id' => '1',
        ]);

        //relacion de la cirugia con el procedimiento
        $procedimiento2->speciality()->attach($especialidad);
        $cirugia->procedure()->attach($procedimiento2);
        $employe->procedures()->attach($procedimiento2);

          //creando procedimiento
        $procedimiento3 = factory(App\Procedure::class)->create([
            'name' => 'Uncinectomia bilateral',
            'description' => 'Extracción de la porción media de unciforme',

            'price' => 2500,
            // 'speciality_id' => $especialidad->id,
            'branch_id' => '1',
        ]);

        //relacion de la cirugia con el procedimiento
        $procedimiento3->speciality()->attach($especialidad);
        $cirugia->procedure()->attach($procedimiento3);
        $employe->procedures()->attach($procedimiento3);

            //creando procedimiento
        $procedimiento4 = factory(App\Procedure::class)->create([
            'name' => 'Antrostomía bilateral',
            'description' => 'Extracción de la porción media de unciforme.
            ',
            'price' => 2500,
            // 'speciality_id' => $especialidad->id,
            'branch_id' => '1',
        ]);

        //relacion de la cirugia con el procedimiento
        // $especialidad->procedures()->attach($procedimiento);
        $cirugia->procedure()->attach($procedimiento4);
        $employe->procedures()->attach($procedimiento4);

        //=========================  Procedimientos otros ==========================

        $pro1= factory(Procedure::class)->create([
            'name'    => 'Cura post operatoria (rinoplastia, blefaroplastia,otoplastia, bichectomia)',
            'price' => 15000,
        ]);
        $employe->procedures()->attach($pro1);

        $pro2= factory(Procedure::class)->create([
            'name'    => 'Colocación de botox estético (acido hialuronico, toxina botulínica)',
           
             'price' => 35000,
        ]);
        $employe->procedures()->attach($pro2);

        $pro3= factory(Procedure::class)->create([
            'name'    => 'Plasma rico en plaquetas (estético)',
            
             'price' => 25000,
        ]);
        $employe->procedures()->attach($pro3);

        $pro4= factory(Procedure::class)->create([
            'name'    => 'Colocación de hilos PDO',
             
             'price' => 18000,
        ]);
        $employe->procedures()->attach($pro4);

        $pro5= factory(Procedure::class)->create([
            'name'    => ' Nutrición facial (peelin, microdermacioin)',
             
             'price' => 22000,
        ]);
        $employe->procedures()->attach($pro5);

        $pro6= factory(Procedure::class)->create([
            'name'    => ' Dermapen',
             
             'price' => 22000,
        ]);
        $employe->procedures()->attach($pro6);

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

            //========================= Datos para cirugia ambulatoria =========================================

            $clasificacion = factory(App\ClassificationSurgery::class)->create([
                'name' => 'ambulatoria',
                'description' => 'altas el mismo día',
                'branch_id' => '1',
            ]);
    
            //creando cirugia
            $cirugia = factory(App\Typesurgery::class)->create([
                'name' => 'Endoscopica Nasosinusal',
                'duration' => 3,
                'cost' => 25000.00,
                'description' => 'Se realiza para remodelar las estructuras de la cabeza y el cuello, por lo general la nariz, 
                las orejas, el mentón, los pómulos y el cuello',
                'day_hospitalization' => 'ambulatoria',
                'classification_surgery_id' => $clasificacion->id,
                'branch_id' => '1',
            ]);
            $this->to('surgeries', $cirugia->id, 'App\Typesurgery');
    

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
            
        // $schedule = factory(Schedule::class, rand(1,3))->create([
        //     'employe_id' => $employe->id
        // ]);

        factory(Schedule::class)->create([
            'day' => 'thursday',
            'turn' => 'tarde',
            'employe_id' => $employe->id
        ]);

        factory(Schedule::class)->create([
            'day' => 'tuesday',
            'turn' => 'tarde',
            'employe_id' => $employe->id
        ]);

        factory(Schedule::class)->create([
            'day' => 'monday',
            'turn' => 'mañana',
            'employe_id' => $employe->id
        ]);


        /*
        * Area a que pertenece
        */
        $typearea = factory(TypeArea::class)->create([
            'name' => 'Consultorio'
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 1',
            'type_area_id' =>  $typearea->id,
        ]);


        $area = factory(Area::class)->create([
            'name'          => 'consultorio 2',
            'type_area_id' =>  $typearea->id,
        ]);

        $asignada = factory(AreaAssigment::class)->create([
            'employe_id' =>  $employe->id,
            'area_id' =>  $area->id
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
            for ($i=0; $i < rand(1,3) ; $i++) { 
                $disease = Disease::inRandomOrder()->first();
                $disease->patient()->attach($patient->id);
            }

            /**
             * Tratamiento para el paciente
             * y su daignostico
             */

            // for ($i=0; $i < rand(1,3) ; $i++) { 
            //     $medicine = Medicine::inRandomOrder()->first();
            //     $medicine->patient()->attach($patient->id);
            // }
            
            // $medicine = factory(App\Medicine::class)->create();

            // $treatment = factory(App\Treatment::class)->create([
            //     'medicine_id' => $medicine->id,
            // ]);

            // $treatment = Treatment::inRandomOrder()->first();
            // factory(App\Diagnostic::class)->create([
            //     'employe_id' => $employe->id,
            //     'patient_id' => $patient->id,
            //     'treatment_id' => $treatment->id,
            //     // 'description' => 'Rinosinusitis Crónica, Desviación Septal, Hipertrofia Turbinal Inferior Bilateral',
            // ]);

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
                // $medicine = factory(App\Medicine::class)->create();
                // $treatment = factory(App\Treatment::class)->create([
                //     'medicine_id' => $medicine->id,
                // ]);
                // // $treatment = Treatment::inRandomOrder()->first();
                // factory(App\Diagnostic::class)->create([
                //     'employe_id' => $employe->id,
                //     'patient_id' => $patient->id,
                //     'treatment_id' => $treatment->id
                // ]);
    
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
                    // $medicine = factory(App\Medicine::class)->create();
                    // $treatment = factory(App\Treatment::class)->create([
                    //     'medicine_id' => $medicine->id,
                    // ]);
                    // // $treatment = Treatment::inRandomOrder()->first();
                    // factory(App\Diagnostic::class)->create([
                    //     'employe_id' => $employe->id,
                    //     'patient_id' => $patient->id,
                    //     'treatment_id' => $treatment->id,
                    // ]);
        
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

 //=============================================================================================================================================================

        /*
        * Creacion del 2do doctor
        */
        $person1 = Person::create([
            'type_dni' => 'N',
            'dni' => '12345678',
            'name' => 'JOSE PASTOR',
            'lastname' => 'LINAREZ',
            'address' => 'la mora',
            'phone' => '(594) 466-3901 x408',
            'email' => 'drjoselinarez@sinusandface.com',
            'branch_id' => '1',
        ]);

        /**
         * Se registra el medico
         * creado en la tabla empleado
         */
        $employe1 = factory(App\Employe::class)->create([
            'person_id' => $person1->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe1->id, 'App\Employe');
        
         /**
         * clase de medico
         * 
         */

        $type = factory(App\TypeDoctor::class)->create([
            'name' => 'Clase B',
        ]);

        $clase = factory(App\Doctor::class)->create([
            'employe_id' => $employe1->id,
            'type_doctor_id' => $type->id,
            'price' => 50000,
            'branch_id' => '1',
        ]);

        //relacion de especialidad con el medico
        $especialidad->employe()->attach($employe1->id);

        //procedimiento de consulta
        $employe1->procedures()->attach($pro);

        //creando procedimiento
        $employe1->procedures()->attach($procedimiento);

          //creando procedimiento
        $employe1->procedures()->attach($procedimiento2);

          //creando procedimiento
        $employe1->procedures()->attach($procedimiento3);

        //creando procedimiento
        $employe1->procedures()->attach($procedimiento4);

        //creando procedimientos otros
        $pro= factory(Procedure::class)->create([
            'name'    => 'Cura post-operatoria (por nasosinusal o tumores, retiros de puntos, aspiración en cada fosa nasal)',
             
             'price' => 10000,
        ]);
        $employe1->procedures()->attach($pro);

        $pro1= factory(Procedure::class)->create([
            'name'    => 'Cauterización al paciente (por hemorragia)',
             
             'price' => 20000,
        ]);
        $employe1->procedures()->attach($pro1);

        $pro2= factory(Procedure::class)->create([
            'name'    => 'Aspiración en oídos (ya sea por cuerpo extraño u otocerumen en ambos oídos)',
             
             'price' => 15000,
        ]);
        $employe1->procedures()->attach($pro2);

        $pro3= factory(Procedure::class)->create([
            'name'    => 'Bloqueo esfenopalatino',
             
             'price' => 17000,
        ]);
        $employe1->procedures()->attach($pro3);

        $pro4= factory(Procedure::class)->create([
            'name'    => 'Estudio de NASOVIDEOLARINGOSCOPIA (en consulta con óptica)',
             
             'price' => 30000,
        ]);
        $employe1->procedures()->attach($pro4);

            /**
             * se crea el usuario
             * del empleado
             */
            factory(User::class)->create([
                'email'     => $person1->email,
                'person_id' => $person1->id,
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
            // $schedule = factory(Schedule::class, rand(1,3))->create([
            //     'employe_id' => $employe1->id
            // ]);

            factory(Schedule::class)->create([
                'day' => 'thursday',
                'turn' => 'tarde',
                'employe_id' => $employe1->id
            ]);
    
            factory(Schedule::class)->create([
                'day' => 'wednesday',
                'turn' => 'mañana',
                'employe_id' => $employe1->id
            ]);
    
            factory(Schedule::class)->create([
                'day' => 'monday',
                'turn' => 'mañana',
                'employe_id' => $employe1->id
            ]);

            factory(Area::class)->create([
                'name'          => 'consultorio 3',
                'type_area_id' =>  $typearea->id,
            ]);
    
            factory(Area::class)->create([
                'name'          => 'consultorio 4',
                'type_area_id' =>  $typearea->id,
            ]);

            $area1 = factory(Area::class)->create([
                'name'          => 'consultorio 5',
                'type_area_id' =>  $typearea->id,
            ]);

            $asignada = factory(AreaAssigment::class)->create([
                'employe_id' =>  $employe1->id,
                'area_id' =>  $area1->id
            ]);

            /**
             * Personas que seran los pacientes
             */
            $person = Person::create([
                'type_dni' => 'N',
                'dni' => '10755003',
                'name' => 'LAURA',
                'lastname' => 'CORTEZ',
                'address' => 'El Paraiso',
                'phone' => '04127501501',
                'email' => ' lauracortez@gmail.com',
                'branch_id' => '1',
            ]);
    
                $this->to('person', $person->id, 'App\Person');
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(App\Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe1->id
                ]);

                // dd($patient);
                    
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
            //     // $medicine = factory(App\Medicine::class)->create();
            //     // $treatment = factory(App\Treatment::class)->create([
            //     //     'medicine_id' => $medicine->id,
            //     // ]);
            //     // // $treatment = Treatment::inRandomOrder()->first();
            //     // factory(App\Diagnostic::class)->create([
            //     //     'employe_id' => $employe->id,
            //     //     'patient_id' => $patient->id,
            //     //     'treatment_id' => $treatment->id
            //     // ]);
    
                /**
                 * Registro de la reservacion
                 */
                $reservation= factory(App\Reservation::class)->create([
                    'patient_id'     => $person->id,
                    'person_id'      => $person1->id,
                    'schedule_id'    => $employe1->schedule->first()->id,
                    'specialitie_id' => $employe1->speciality->first()->id,
                ]);

                // dd($reservation);
    
                $person = Person::create([
                    'type_dni' => 'N',
                    'dni' => '12184037',
                    'name' => 'MANUEL',
                    'lastname' => 'CORREA',
                    'address' => 'San Felipe',
                    'phone' => '04164891502',
                    'email' => 'manuelc@hotmail.com',
                    'branch_id' => '1',
                ]);
        
                    $this->to('person', $person->id, 'App\Person');
                    /**
                     * Registro de la historia medica
                     * con su fotografia
                     */
                    $patient = factory(App\Patient::class)->create([
                        'person_id' => $person->id,
                        'employe_id' => $employe1->id
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
            //         // $medicine = factory(App\Medicine::class)->create();
            //         // $treatment = factory(App\Treatment::class)->create([
            //         //     'medicine_id' => $medicine->id,
            //         // ]);
            //         // // $treatment = Treatment::inRandomOrder()->first();
            //         // factory(App\Diagnostic::class)->create([
            //         //     'employe_id' => $employe->id,
            //         //     'patient_id' => $patient->id,
            //         //     'treatment_id' => $treatment->id
            //         // ]);
        
                    /**
                     * Registro de la reservacion
                     */
                    factory(App\Reservation::class)->create([
                        'patient_id'     => $person->id,
                        'person_id'      => $person1->id,
                        'schedule_id'    => $employe1->schedule->first()->id,
                        'specialitie_id' => $employe1->speciality->first()->id,
                    ]);
    
                    $person = Person::create([
                        'type_dni' => 'N',
                        'dni' => '18184030',
                        'name' => 'VICENTE',
                        'lastname' => 'ROJAS',
                        'address' => 'Barrio Union',
                        'phone' => '04243654150',
                        'email' => 'vicenterojas@gmail.com',
                        'branch_id' => '1',
                    ]);
            
                        $this->to('person', $person->id, 'App\Person');
                        /**
                         * Registro de la historia medica
                         * con su fotografia
                         */
                        $patient = factory(App\Patient::class)->create([
                            'person_id' => $person->id,
                            'employe_id' => $employe1->id
                        ]);
                            
                        /**
                         * Enfermedades del paciente
                         */
                        for ($i=0; $i < rand(1,5) ; $i++) { 
                            $disease = Disease::inRandomOrder()->first();
                            $disease->patient()->attach($patient->id);
                        }
            
            //             /**
            //              * Tratamiento para el paciente
            //              * y su daignostico
            //              */
            //             // $medicine = factory(App\Medicine::class)->create();
            //             // $treatment = factory(App\Treatment::class)->create([
            //             //     'medicine_id' => $medicine->id,
            //             // ]);
            //             // // $treatment = Treatment::inRandomOrder()->first();
            //             // factory(App\Diagnostic::class)->create([
            //             //     'employe_id' => $employe->id,
            //             //     'patient_id' => $patient->id,
            //             //     'treatment_id' => $treatment->id
            //             // ]);
            
                        /**
                         * Registro de la reservacion
                         */
                        factory(App\Reservation::class)->create([
                            'patient_id'     => $person->id,
                            'person_id'      => $person1->id,
                            'schedule_id'    => $employe1->schedule->first()->id,
                            'specialitie_id' => $employe1->speciality->first()->id,
                        ]);
    //============================================================================================================
        /*
        * Creacion del 3er doctor
        */
        $person2 = Person::create([
            'type_dni' => 'N',
            'dni' => '15729752',
            'name' => 'VICTORIA',
            'lastname' => 'CANELON',
            'address' => 'Urbanizacion el Trigal calle 6 transversal 2',
            'phone' => '0426 - 5656745',
            'email' => 'dravictoria@sinusandface.com',
            'branch_id' => '1',
        ]);

        /**
         * Se registra el medico
         * creado en la tabla empleado
         */
        $employe2 = factory(App\Employe::class)->create([
            'person_id' => $person2->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe2->id, 'App\Employe');
        
         /**
         * clase de medico
         * 
         */

        $type = factory(App\TypeDoctor::class)->create([
            'name' => 'Clase B',
        ]);

        $clase = factory(App\Doctor::class)->create([
            'employe_id' => $employe2->id,
            'type_doctor_id' => $type->id,
            'price' => 50000,
            'branch_id' => '1',
        ]);

        $especialidad2 = factory(App\Speciality::class)->create([
            'name' => 'Oftalmología',
            'description' => 'Estudia las enfermedades de ojo y su tratamiento, incluyendo el globo ocular, su musculatura, el sistema lagrimal y los párpados.',
            'service_id' => 2,
            'branch_id' => '1',
            ]);
            
        //relacion de especialidad con el medico
        $especialidad2->employe()->attach($employe2->id);

        //procedimiento de consulta
        $employe2->procedures()->attach($pro);

        //creando procedimientos otros
        $pro5= factory(Procedure::class)->create([
            'name'    => 'Cateterismo o sondaje vía lagrimal.',
             
             'price' => 20000,
        ]);
        $employe2->procedures()->attach($pro5);

        $pro1= factory(Procedure::class)->create([
            'name'    => 'Chalazión y otros tumores benignos.',
             
             'price' => 20000,
        ]);
        $employe2->procedures()->attach($pro1);

        $pro2= factory(Procedure::class)->create([
            'name'    => 'Curva de tensión ocular',
             
             'price' => 15000,
        ]);
        $employe2->procedures()->attach($pro2);

        $pro3= factory(Procedure::class)->create([
            'name'    => 'Exploración vitreorretinal',
             
             'price' => 17000,
        ]);
        $employe2->procedures()->attach($pro3);

        $pro4= factory(Procedure::class)->create([
            'name'    => 'Microscopia especular',
             
             'price' => 30000,
        ]);
        $employe2->procedures()->attach($pro4);

            /**
             * se crea el usuario
             * del empleado
             */
            factory(User::class)->create([
                'email'     => $person2->email,
                'person_id' => $person2->id,
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
            // $schedule = factory(Schedule::class, rand(1,3))->create([
            //     'employe_id' => $employe2->id
            // ]);

            factory(Schedule::class)->create([
                'day' => 'thursday',
                'turn' => 'tarde',
                'employe_id' => $employe2->id
            ]);
    
            factory(Schedule::class)->create([
                'day' => 'wednesday',
                'turn' => 'mañana',
                'employe_id' => $employe2->id
            ]);
    
            factory(Schedule::class)->create([
                'day' => 'tuesday',
                'turn' => 'mañana',
                'employe_id' => $employe2->id
            ]);

            /*
            * Asignacion de consultorio
            */

            factory(Area::class)->create([
                'name'          => 'consultorio 6',
                'type_area_id' =>  $typearea->id,
            ]);

            $area2 = factory(Area::class)->create([
                'name' => 'Consultorio 7',
                'status' => 'ocupado',
                'type_area_id' =>  $typearea->id
            ]);

            $asignada = factory(AreaAssigment::class)->create([
                'employe_id' =>  $employe2->id,
                'area_id' =>  $area2->id
            ]);


            /**
             * Personas que seran los pacientes
             */
            $person = Person::create([
                'type_dni' => 'N',
                'dni' => '15729753',
                'name' => 'DIANA',
                'lastname' => 'ALVAREZ',
                'address' => 'El Paraiso',
                'phone' => '04125656745',
                'email' => '    dianaalvarez@gmail.com',
                'branch_id' => '1',
            ]);
    
                $this->to('person', $person->id, 'App\Person');
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(App\Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe2->id
                ]);

                // dd($patient);
                    
                /**
                 * Enfermedades del paciente
                 */
                for ($i=0; $i < rand(1,5) ; $i++) { 
                    $disease = Disease::inRandomOrder()->first();
                    $disease->patient()->attach($patient->id);
                }
    
                /**
                 * Registro de la reservacion
                 */
                $reservation= factory(App\Reservation::class)->create([
                    'patient_id'     => $person->id,
                    'person_id'      => $person2->id,
                    'schedule_id'    => $employe2->schedule->first()->id,
                    'specialitie_id' => $employe2->speciality->first()->id,
                ]);

    //============================================================================================================
        /*
        * Creacion del 4to doctor
        */
        $person3 = Person::create([
            'type_dni' => 'N',
            'dni' => '15729754',
            'name' => 'MIGUEL',
            'lastname' => 'BRICEÑO',
            'address' => 'Avenida el Placer',
            'phone' => '0414 - 5656745',
            'email' => 'drmiguelb@sinusandface.com',
            'branch_id' => '1',
        ]);

        /**
         * Se registra el medico
         * creado en la tabla empleado
         */
        $employe3 = factory(App\Employe::class)->create([
            'person_id' => $person3->id,
            'position_id' => $position->id
        ]);
        $this->to('employes', $employe3->id, 'App\Employe');
        
         /**
         * clase de medico
         * 
         */

        $type = factory(App\TypeDoctor::class)->create([
            'name' => 'Clase A',
        ]);

        $clase = factory(App\Doctor::class)->create([
            'employe_id' => $employe3->id,
            'type_doctor_id' => $type->id,
            'price' => 100000,
            'branch_id' => '1',
        ]);

        $especialidad3 = factory(App\Speciality::class)->create([
            'name' => 'Ginecología',
            'description' => 'Estudia el sistema reproductor femenino.',
            'service_id' => 2,
            'branch_id' => '1',
            ]);
            
        //relacion de especialidad con el medico
        $especialidad3->employe()->attach($employe3->id);

        //procedimiento de consulta
        $employe3->procedures()->attach($pro);

        //creando procedimientos otros
        $pro5= factory(Procedure::class)->create([
            'name'    => 'Citología de Cuello uterino.',
             
             'price' => 20000,
        ]);
        $employe3->procedures()->attach($pro5);

        $pro1= factory(Procedure::class)->create([
            'name'    => 'Colposcopias.',
             
             'price' => 20000,
        ]);
        $employe3->procedures()->attach($pro1);

        $pro2= factory(Procedure::class)->create([
            'name'    => 'Biopsias de cérvix y área genital (vulva clítoris, entre otros)',
             
             'price' => 15000,
        ]);
        $employe3->procedures()->attach($pro2);

        $pro3= factory(Procedure::class)->create([
            'name'    => 'Vaporización',
             
             'price' => 17000,
        ]);
        $employe2->procedures()->attach($pro3);

        $pro4= factory(Procedure::class)->create([
            'name'    => 'Retiro e inserción de DIU',
             
             'price' => 30000,
        ]);
        $employe3->procedures()->attach($pro4);

        $pro6= factory(Procedure::class)->create([
            'name'    => 'Resección de pólipo endometrial',
             
             'price' => 40000,
        ]);
        $employe3->procedures()->attach($pro6);

            /**
             * se crea el usuario
             * del empleado
             */
            factory(User::class)->create([
                'email'     => $person3->email,
                'person_id' => $person3->id,
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
            // $schedule = factory(Schedule::class, rand(1,3))->create([
            //     'employe_id' => $employe3->id
            // ]);

            factory(Schedule::class)->create([
                'day' => 'thursday',
                'turn' => 'tarde',
                'employe_id' => $employe3->id
            ]);
    
            factory(Schedule::class)->create([
                'day' => 'wednesday',
                'turn' => 'tarde',
                'employe_id' => $employe3->id
            ]);
    
            factory(Schedule::class)->create([
                'day' => 'tuesday',
                'turn' => 'tarde',
                'employe_id' => $employe3->id
            ]);


            /*
            * Asignacion de consultorio
            */
            factory(Area::class)->create([
                'name'          => 'consultorio 8',
                'type_area_id' =>  $typearea->id,
            ]);

            $area3 = factory(Area::class)->create([
                'name' => 'Consultorio 9',
                'status' => 'ocupado',
                'type_area_id' =>  $typearea->id
            ]);

            $asignada = factory(AreaAssigment::class)->create([
                'employe_id' =>  $employe3->id,
                'area_id' =>  $area3->id
            ]);

            /**
             * Personas que seran los pacientes
             */
            $person = Person::create([
                'type_dni' => 'N',
                'dni' => '15729754',
                'name' => 'ELENA',
                'lastname' => 'PUERTA',
                'address' => 'Las Mercedes diagonal a la Panaderia San Benito',
                'phone' => '04125656746',
                'email' => 'elenapuerta@gmail.com',
                'branch_id' => '1',
            ]);
    
                $this->to('person', $person->id, 'App\Person');
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                $patient = factory(App\Patient::class)->create([
                    'person_id' => $person->id,
                    'employe_id' => $employe3->id
                ]);

                // dd($patient);
                    
                /**
                 * Enfermedades del paciente
                 */
                for ($i=0; $i < rand(1,5) ; $i++) { 
                    $disease = Disease::inRandomOrder()->first();
                    $disease->patient()->attach($patient->id);
                }
    
                /**
                 * Registro de la reservacion
                 */
                $reservation= factory(App\Reservation::class)->create([
                    'patient_id'     => $person->id,
                    'person_id'      => $person3->id,
                    'schedule_id'    => $employe3->schedule->first()->id,
                    'specialitie_id' => $employe3->speciality->first()->id,
                ]);

                //=============================================================================================================
                /*
                * Creacion de areas restantes
                */
        
               
                factory(Area::class)->create([
                    'name'          => 'consultorio 10',
                    'type_area_id' =>  $typearea->id,
                ]);
                
                $tipo = factory(TypeArea::class)->create([
                    'name' => 'Quirofano',
                ]);
        
                factory(Area::class)->create([
                    'name'          => 'Quirofano 1',
                    'type_area_id' =>  $tipo->id,
                ]);
        
                factory(Area::class)->create([
                    'name'          => 'Quirofano 2',
                    'type_area_id' =>  $tipo->id,
                ]);
        
                factory(Area::class)->create([
                    'name'          => 'Quirofano 3',
                    'type_area_id' =>  $tipo->id,
                ]);
        
                factory(Area::class)->create([
                    'name'          => 'Quirofano 4',
                    'type_area_id' =>  $tipo->id,
                ]);
        
                // factory(Area::class)->create()->each(function($area)
                // {
                //     $this->to('area', $area->id, 'App\Area');
                // });

            /**
             * Personas que seran los pacientes
             */
            // $persons = factory(Person::class, 3)->create()->each(function ($person) use ($employe) {
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                // $patient = factory(Patient::class)->create([
                //     'person_id' => $person->id,
                //     'employe_id' => $employe->id
                // ]);
                // $this->to('person', $person->id, 'App\Person');
                    
                /**
                 * Enfermedades del paciente
                 */
                // for ($i=0; $i < rand(1,5) ; $i++) { 
                //     $disease = Disease::inRandomOrder()->first();
                //     $disease->patient()->attach($patient->id);
                // }

                /**
                 * Tratamiento para el paciente
                 * y su diagnostico
                 */
                // $medicine = factory(App\Medicine::class)->create();
                // $treatment = factory(App\Treatment::class)->create([
                //     'medicine_id' => $medicine->id,
                // ]);
                // $treatment = Treatment::inRandomOrder()->first();
                // factory(App\Diagnostic::class)->create([
                //     'employe_id'    => $employe->id,
                //     'patient_id'    => $patient->id,
                //     'treatment_id'  => $treatment->id
                // ]);

                /**
                 * Registro de la reservacion
                 */
        //         factory(App\Reservation::class)->create([
        //             'patient_id'     => $person->id,
        //             'person_id'      => $employe->id,
        //             'schedule_id'    => $employe->schedule->first()->id,
        //             'specialitie_id' => $employe->speciality->first()->id,
        //         ]);
        //     });
        // });

         /**
         * Registro de 10 usuarios medicos de 
         * manera automatica se crean primero 
         * las 10 personas que seran los medicos
         */
        // factory(Person::class, 3)->create()->each(function ($person) use ($position) {
            /**
             * Por cada persona se
             * registra en la tabla de los
             * empleados, con su imagen
             */
            // $employe = factory(App\Employe::class)->create([
            //     'person_id' => $person->id,
            //     'position_id' => $position->id
            // ]);
            // $this->to('employes', $employe->id, 'App\Employe');

            // $type = factory(App\TypeDoctor::class)->create([
            //     'name' => 'Clase A',
            // ]);
            // $clase = factory(App\Doctor::class)->create([
            //     'employe_id' => $employe->id,
            //     'type_doctor_id' => $type->id
            // ]);

            /**
             * Especialidades para el medico
             * y sus procedimientos
             */
            // $num = rand(1,3);
            // for ($i=0; $i < $num ; $i++) { 
            //     $speciality = Speciality::inRandomOrder()->first();
            //     $speciality->employe()->attach($employe->id);
                // foreach ($speciality->procedures as $procedure) {
                //     $procedure->employe()->attach($employe->id);
                // }
            // }

            /**
             * se crea el usuario
             * del empleado
             */
            // factory(User::class)->create([
            //     'email'     => $person->email,
            //     'person_id' => $person->id,
            // ])->givePermissionTo('ver lista de pacientes')
            //     ->givePermissionTo('crear historia de paciente')
            //     ->givePermissionTo('crear diagnostico')
            //     ->givePermissionTo('elegir examenes a realizar')
            //     ->givePermissionTo('elegir procedimientos a realizar')
            //     ->givePermissionTo('crear recipe')
            //     ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

            /**
             * Se crea el horario del medico
             */
            // $schedule = factory(Schedule::class, rand(1,3))->create([
            //     'employe_id' => $employe->id
            // ]);

            /**
             * Personas que seran los pacientes
             */
            // $persons = factory(Person::class, 3)->create()->each(function ($person) use ($employe) {
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                // $patient = factory(Patient::class)->create([
                //     'person_id' => $person->id,
                //     'employe_id' => $employe->id
                // ]);
                // $this->to('person', $person->id, 'App\Person');
                    
                /**
                 * Enfermedades del paciente
                 */
                // for ($i=0; $i < rand(1,5) ; $i++) { 
                //     $disease = Disease::inRandomOrder()->first();
                //     $disease->patient()->attach($patient->id);
                // }

                /**
                 * Tratamiento para el paciente
                 * y su diagnostico
                 */
                // $medicine = factory(App\Medicine::class)->create();
                // $treatment = factory(App\Treatment::class)->create([
                //     'medicine_id' => $medicine->id,
                // ]);
                // $treatment = Treatment::inRandomOrder()->first();
                // factory(App\Diagnostic::class)->create([
                //     'employe_id'    => $employe->id,
                //     'patient_id'    => $patient->id,
                //     'treatment_id'  => $treatment->id
                // ]);

                /**
                 * Registro de la reservacion
                 */
            //     factory(App\Reservation::class)->create([
            //         'patient_id'     => $person->id,
            //         'person_id'      => $employe->id,
            //         'schedule_id'    => $employe->schedule->first()->id,
            //         'specialitie_id' => $employe->speciality->first()->id,
            //     ]);
            // });
        // });

         /**
         * Registro de 10 usuarios medicos de 
         * manera automatica se crean primero 
         * las 10 personas que seran los medicos
         */
        // factory(Person::class, 3)->create()->each(function ($person) use ($position) {
            /**
             * Por cada persona se
             * registra en la tabla de los
             * empleados, con su imagen
             */
            // $employe = factory(App\Employe::class)->create([
            //     'person_id' => $person->id,
            //     'position_id' => $position->id
            // ]);
            // $this->to('employes', $employe->id, 'App\Employe');

            // $type = factory(App\TypeDoctor::class)->create([
            //     'name' => 'Clase C',
            // ]);
            // $clase = factory(App\Doctor::class)->create([
            //     'employe_id' => $employe->id,
            //     'type_doctor_id' => $type->id,
            //     'price' => 20000
            // ]);

            /**
             * Especialidades para el medico
             * y sus procedimientos
             */
            // $num = rand(1,3);
            // for ($i=0; $i < $num ; $i++) { 
            //     $speciality = Speciality::inRandomOrder()->first();
            //     $speciality->employe()->attach($employe->id);
                // foreach ($speciality->procedures as $procedure) {
                //     $procedure->employe()->attach($employe->id);
                // }
            // }

            /**
             * se crea el usuario
             * del empleado
             */
            // factory(User::class)->create([
            //     'email'     => $person->email,
            //     'person_id' => $person->id,
            // ])->givePermissionTo('ver lista de pacientes')
            //     ->givePermissionTo('crear historia de paciente')
            //     ->givePermissionTo('crear diagnostico')
            //     ->givePermissionTo('elegir examenes a realizar')
            //     ->givePermissionTo('elegir procedimientos a realizar')
            //     ->givePermissionTo('crear recipe')
            //     ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

            /**
             * Se crea el horario del medico
             */
            // $schedule = factory(Schedule::class, rand(1,3))->create([
            //     'employe_id' => $employe->id
            // ]);

            /**
             * Personas que seran los pacientes
             */
            // $persons = factory(Person::class, 3)->create()->each(function ($person) use ($employe) {
                /**
                 * Registro de la historia medica
                 * con su fotografia
                 */
                // $patient = factory(Patient::class)->create([
                //     'person_id' => $person->id,
                //     'employe_id' => $employe->id
                // ]);
                // $this->to('person', $person->id, 'App\Person');
                    
                /**
                 * Enfermedades del paciente
                 */
                // for ($i=0; $i < rand(1,5) ; $i++) { 
                //     $disease = Disease::inRandomOrder()->first();
                //     $disease->patient()->attach($patient->id);
                // }

                /**
                 * Tratamiento para el paciente
                 * y su diagnostico
                 */
                // $medicine = factory(App\Medicine::class)->create();
                // $treatment = factory(App\Treatment::class)->create([
                //     'medicine_id' => $medicine->id,
                // ]);
                // $treatment = Treatment::inRandomOrder()->first();
                // factory(App\Diagnostic::class)->create([
                //     'employe_id'    => $employe->id,
                //     'patient_id'    => $patient->id,
                //     'treatment_id'  => $treatment->id
                // ]);

                /**
                 * Registro de la reservacion
                 */
        //         factory(App\Reservation::class)->create([
        //             'patient_id'     => $person->id,
        //             'person_id'      => $employe->id,
        //             'schedule_id'    => $employe->schedule->first()->id,
        //             'specialitie_id' => $employe->speciality->first()->id,
        //         ]);
        //     });
        // });


        $person = Person::create([
            'type_dni' => 'N',
            'dni' => '12345678',
            'name' => 'EDUARDO',
            'lastname' => 'MARIN',
            'address' => 'La Mata',
            'phone' => '(594) 466-32001 x408',
            'email' => 'seguridad@sinusandface.com',
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
            'email' => 'eduardom@sinusandface.com',
            'person_id' => $person->id,
        ])->givePermissionTo('Registrar visitantes')
            ->givePermissionTo('Ver lista de visitantes')->assignRole('seguridad');


        // factory(Person::class, 2)->create()->each(function ($person) use ($position) {
        //     factory(App\Employe::class)->create([
        //         'person_id' => $person->id,
        //         'position_id' => $position->id
        //     ]);
        //     factory(App\User::class)->create([
        //         'email'     => $person->email,
        //         'person_id' => $person->id
        //     ])->assignRole('seguridad');
        // });

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


        // factory(Person::class, 2)->create()->each(function ($person) use ($position) {
        //     factory(App\Employe::class)->create([
        //         'person_id' => $person->id,
        //         'position_id' => $position->id
        //     ]);
        //     factory(App\User::class)->create([
        //         'email'     => $person->email,
        //         'person_id' => $person->id
        //     ])->assignRole('recepcion');
        // });

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


        // factory(Person::class, 2)->create()->each(function ($person) use ($position) {
        //     factory(App\Employe::class)->create([
        //         'person_id' => $person->id,
        //         'position_id' => $position->id
        //     ]);
        //     factory(App\User::class)->create([
        //         'email'     => $person->email,
        //         'person_id' => $person->id
        //     ])->assignRole('IN');
        // });

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


        // factory(Person::class, 2)->create()->each(function ($person) use ($position) {
        //     factory(App\Employe::class)->create([
        //         'person_id' => $person->id,
        //         'position_id' => $position->id
        //     ]);
        //     factory(App\User::class)->create([
        //     'email' => $person->email,
        //         'person_id' => $person->id
        //     ])->assignRole('OUT');
        // });

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

        ])->givePermissionTo(Permission::all())
        ->assignRole(Role::all());

        factory(Position::class)->create([
            'name'    => 'mantenimiento',
        ]);

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
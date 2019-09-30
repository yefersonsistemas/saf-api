<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Person;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ->givePermissionTo('')
     * @return void
     */
    public function run()
    {
        User::truncate();
        Person::truncate();

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

        factory(User::class)->create([
            'person_id' => $person->id,
        ])->givePermissionTo('Registrar visitantes')
          ->givePermissionTo('Ver lista de visitantes')->assignRole('seguridad');

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

        factory(User::class)->create([
            'person_id' => $person->id,
            
        ])->givePermissionTo('ver lista de pacientes')
            ->givePermissionTo('crear historia de paciente')
            ->givePermissionTo('crear diagnostico')
            ->givePermissionTo('elegir examenes a realizar')
            ->givePermissionTo('elegir procedimientos a realizar')
            ->givePermissionTo('crear recipe')
            ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345671',
            'name' => 'GABRIELA',
            'lastname' => 'LINAREZ',
            'address' => 'agua viva',
            'phone' => '1-735-709-8377 x0026',
            'email' => 'dragabrielalinarez@sinusandface.com',
            'branch_id' => '1',
        ]);

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver lista de pacientes')
            ->givePermissionTo('crear historia de paciente')
            ->givePermissionTo('crear diagnostico')
            ->givePermissionTo('elegir examenes a realizar')
            ->givePermissionTo('elegir procedimientos a realizar')
            ->givePermissionTo('crear recipe')
            ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');

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

        factory(User::class)->create([
            'person_id' => $person->id,

        ]) ->givePermissionTo('asignar consultorio')
            ->givePermissionTo('crear factura')
            ->givePermissionTo('Recibir notificacion de paciente de salida')->assignRole('IN');

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

        factory(User::class)->create([
            'person_id' => $person->id,

        ]) ->givePermissionTo('asignar consultorio')
            ->givePermissionTo('crear factura')
            ->givePermissionTo('Recibir notificacion de paciente candidato a cirugia')->assignRole('OUT');

        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345674',
            'name' => 'MARIA ELENA',
            'lastname' => 'RIVERO',
            'address' => 'el recreo',
            'phone' => '294-887-9515 x862',
            'email' => 'administracion1@sinusandface.com',
            'branch_id' => '1',
        ]);

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver cuentas por pagar')
            ->givePermissionTo('ver cuentas por cobrar')
            ->givePermissionTo('Crear reporte')->assignRole('administracion');

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

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver lista de pacientes')
            ->givePermissionTo('crear cita')->assignRole('recepcion');

        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345676',
            'name' => 'YSBELIA',
            'lastname' => 'CARIAZO',
            'address' => 'venezuela',
            'phone' => '292-787-95415 x861',
            'email' => 'ycariazo@sinusandface.com',
            'branch_id' => '1',
        ]);

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver insumo')
            ->givePermissionTo('registrar insumo')
            ->givePermissionTo('modificar insumo')
            ->givePermissionTo('eliminar insumo')
            ->givePermissionTo('asignar insumo')
            ->givePermissionTo('ver equipo')
            ->givePermissionTo('registrar equipo')
            ->givePermissionTo('modificar equipo')
            ->givePermissionTo('eliminar equipo')
            ->givePermissionTo('asignar equipo')
            ->givePermissionTo('ver inventario')
            ->givePermissionTo('ver inventario por area')
            ->givePermissionTo('Registrar limpieza')
            ->givePermissionTo('ver registro de limpieza')
            ->givePermissionTo('Crear reporte')->assignRole('logistica');

        $person = Person::create([
            'type_dni' => 'V',
            'dni' => '12345677',
            'name' => 'HEMBERTH ALEJANDRO',
            'lastname' => 'MEDINA',
            'address' => 'libertador',
            'phone' => '191-780-95415 x861',
            'email' => 'medina@sinusandface.com',
            'branch_id' => '1',
        ]);

        factory(User::class)->create([
            'person_id' => $person->id,

        ])->givePermissionTo('ver lista de pacientes')
            ->givePermissionTo('crear historia de paciente')
            ->givePermissionTo('crear diagnostico')
            ->givePermissionTo('elegir examenes a realizar')
            ->givePermissionTo('elegir procedimientos a realizar')
            ->givePermissionTo('crear recipe')
            ->givePermissionTo('ver historial de pacientes atendidos')->assignRole('doctor');
    }
}

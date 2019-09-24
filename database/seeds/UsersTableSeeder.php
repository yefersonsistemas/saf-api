<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(User::class)->create([
            'name' => 'JOSE PASTOR',
            'lastname' => 'LINAREZ',
            'email' => 'drjoselinarez@sinusandface.com',
            'gender'    => 'MASCULINO',
            'birthdate' => now(),
        ])->givePermissionTo('create diagnostics')->assignRole('doctor');

        factory(User::class)->create([
            'name' => 'NATALIA',
            'lastname' => 'NEIRA',
            'email' => 'dranatalianeira@sinusandface.com',
            'gender'    => 'FEMENINO',
            'phone'     => '(594) 466-3902 x409',
            'birthdate' => now(),
        ])->givePermissionTo('create diagnostics')->assignRole('doctor');

        factory(User::class)->create([
            'name' => 'GABRIELA',
            'lastname' => 'LINAREZ',
            'email' => 'dragabrielalinarez@sinusandface.com',
            'gender'    => 'FEMENINO',
            'phone'     => '1-735-709-8377 x0026',
            'birthdate' => now(),
        ])->givePermissionTo('create diagnostics')->assignRole('doctor');

        factory(User::class)->create([
            'name' => 'ANA KARINA',
            'lastname' => 'COLOMBO',
            'email' => 'coordinador1@sinusandface.com',
            'gender'    => 'FEMENINO',
            'phone'     => '863-247-0437 x789',
            'birthdate' => now(),
        ])->assignRole('assistant');

        factory(User::class)->create([
            'name' => 'LIDIA',
            'lastname' => 'COLOMBO',
            'email' => 'asistente2@sinusandface.com',
            'gender'    => 'FEMENINO',
            'phone'     => '(793) 696-4038 x1936',
            'birthdate' => now(),
        ])->assignRole('assistant');

        factory(User::class)->create([
            'name' => 'MARIA ELENA',
            'lastname' => 'RIVERO',
            'email' => 'asistente1@sinusandface.com',
            'gender'    => 'FEMENINO',
            'phone'     => '294-887-9515 x862',
            'birthdate' => now(),
        ])->assignRole('assistant');

        factory(User::class)->create([
            'name' => 'ANDERLIN',
            'lastname' => 'RODRIGUEZ',
            'email' => 'recepcion@sinusandface.com',
            'gender'    => 'FEMENINO',
            'birthdate' => now(),
        ])->assignRole('assistant');

        factory(User::class)->create([
            'name' => 'LISMAR',
            'lastname' => 'HURTADO',
            'email' => 'asesordesalud1@sinusandface.com',
            'gender'    => 'FEMENINO',
            'birthdate' => now(),
        ])->assignRole('assistant');

        factory(User::class)->create([
            'name' => 'HEMBERTH ALEJANDRO',
            'lastname' => 'MEDINA',
            'email' => 'medina@sinusandface.com',
            'gender'    => 'MASCULINO',
            'birthdate' => now(),
        ])->givePermissionTo('create diagnostics')->assignRole('doctor');

    }
}

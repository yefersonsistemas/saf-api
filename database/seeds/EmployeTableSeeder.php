<?php

use Illuminate\Database\Seeder;
use App\Employe;

class EmployeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employe::truncate();

        factory(Employe::class)->create([
            'person_id'    => '6',
            'position_id'    => '2',
        ]);

        factory(Employe::class, 30)->create();
    }
}

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
        factory(Employe::class, 20)->create();
    }
}

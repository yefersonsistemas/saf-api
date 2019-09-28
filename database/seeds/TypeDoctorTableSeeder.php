<?php

use Illuminate\Database\Seeder;
use App\TypeDoctor;

class TypeDoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDoctor::truncate();
        factory(TypeDoctor::class, 20)->create();
    }
}

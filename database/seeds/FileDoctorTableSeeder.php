<?php

use App\FileDoctor;
use Illuminate\Database\Seeder;

class FileDoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileDoctor::truncate();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\InputOutput;

class InputOutputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InputOutput::truncate();
    }
}

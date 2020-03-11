<?php

use App\FileAnestesiologo;
use Illuminate\Database\Seeder;

class FileAnestesiologoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileAnestesiologo::truncate();
    }
}

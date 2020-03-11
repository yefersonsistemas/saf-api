<?php

use App\FileInternista;
use Illuminate\Database\Seeder;

class FileInternistaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileInternista::truncate();
    }
}

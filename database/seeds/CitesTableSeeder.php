<?php

use App\Cite;
use Illuminate\Database\Seeder;

class CitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cite::truncate();
        //factory(Cite::class)->create();
    }
}

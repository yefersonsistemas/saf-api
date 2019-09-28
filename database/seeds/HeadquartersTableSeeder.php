<?php

use Illuminate\Database\Seeder;
use App\Headquarter;

class HeadquartersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Headquarter::truncate();
        factory(Headquarter::class, 3)->create();
    }
}

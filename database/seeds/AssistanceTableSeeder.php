<?php

use App\Assistance;
use Illuminate\Database\Seeder;

class AssistanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assistance::truncate();
        //factory(Assistance::class)->create();
    }
}

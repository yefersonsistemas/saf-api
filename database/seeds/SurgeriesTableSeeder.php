<?php

use Illuminate\Database\Seeder;
use App\Surgery;
use App\Procedure;

class SurgeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Surgery::truncate();
        factory(Surgery::class, 20)->create();

        // factory(Surgery::class, 20)->create()->each(function ($surgery) { 
        //     $procedure = Procedure::with('employe')->get();  

        //     $surgery->employe()->attach($procedure->random()->id);
        // }); 
    }
}

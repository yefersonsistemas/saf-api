<?php

use Illuminate\Database\Seeder;
use App\Speciality;
use App\Employe;
use App\Branch;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::truncate();
        factory(Speciality::class, 20)->create()->each(function ($speciality) {
            $employes = Employe::with('person.user')->get();

            $employes = $employes->each(function ($employe) {
                if($employe->person->user != null){
                    return $employe->person->user->role('doctor'); 
                } 
            });                                                   

            $speciality->employe()->attach($employes->random()->id); 
        }); 
    }
}

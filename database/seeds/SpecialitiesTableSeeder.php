<?php

use Illuminate\Database\Seeder;
use App\Speciality;
use App\Employe;
use App\Branch;
//use App\Traits\ImageFactory;

class SpecialitiesTableSeeder extends Seeder
{
   // use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::truncate();
        //$this->deleteDirectory(storage_path('/app/public/speciality'));

        factory(Speciality::class, 10)->create()->each(function ($speciality) {
           //$this->to('speciality', $speciality->id, 'App\Speciality');

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

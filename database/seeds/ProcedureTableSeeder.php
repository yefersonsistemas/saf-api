<?php

use Illuminate\Database\Seeder;
use App\Procedure;
use App\Employe;
use App\Branch;

class ProcedureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Procedure::truncate();
        
        factory(Procedure::class, 20)->create()->each(function ($procedure) {
            $employes = Employe::with('person.user')->get();

            $employes = $employes->each(function ($employe) {
                return $employe->person->user->role('doctor');
            });

            $procedure->employe()->attach($employes->random()->id);
        });
    }
}

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

            $employes = $employes->each(function ($employe) { //recorre c/u de los empleados y lo va guardando en item
                return $employe->person->user->role('doctor'); //comparo q el empleado en function (employe) relacionado con persona tenga un
            });                                                   //usuario y q ademas tenga el rol doctor

            $procedure->employe()->attach($employes->random()->id); //attach enlaza los procedures con los empleados encontrados
        });                                                      //de manera aleatoria
    }
}

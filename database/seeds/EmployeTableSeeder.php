<?php

use Illuminate\Database\Seeder;
use App\Employe;
use App\Traits\ImageFactory;

class EmployeTableSeeder extends Seeder
{
    use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employe::truncate();
        $this->deleteDirectory(storage_path('/app/public/employes'));
        factory(Employe::class, 30)->create()->each(function ($employe) {
            $this->to('employes', $employe->id, 'App\Employe');
        });
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Speciality;
use App\Service;
use App\Traits\ImageFactory;

class SpecialitiesTableSeeder extends Seeder
{
    use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::truncate();
        $this->deleteDirectory(storage_path('/app/public/speciality'));

        factory(Speciality::class, 15)->create()->each(function ($speciality) {
            $service = Service::inRandomOrder()->first();
            $speciality->service_id = $service->id;
            $speciality->save();

            //Foto para la especialidad
            $this->to('speciality', $speciality->id, 'App\Speciality');
        });
    }
}

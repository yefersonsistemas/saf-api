<?php

use Illuminate\Database\Seeder;
use App\Person;
use App\Traits\ImageFactory;

class PersonTableSeeder extends Seeder
{
    use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Person::truncate();
        //$this->deleteDirectory(storage_path('/app/public/person'));
        // factory(Person::class, 20)->create()->each(function ($person) {;
            //$this->to('person', $person->id, 'App\Person');
        // });
    }
}

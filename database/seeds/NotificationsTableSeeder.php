<?php

use App\Notification;
use App\Person;
use App\User;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::truncate();
        factory(Notification::class, 5)->create();
        // ->each(function ($notification){
        //     $user = Person::with('patient')->where('id', $notification-> )->get();


        // });
    }
}

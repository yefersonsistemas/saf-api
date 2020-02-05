<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use View;
use Carbon\Carbon;
use App\Reservation;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $day = Reservation::whereDate('date', '=', Carbon::now()->format('Y-m-d'))->whereNotNull('approved')->with('person', 'patient.image', 'patient.historyPatient', 'patient.inputoutput','speciality')->get();

        $atendidos = collect([]);

        foreach ($day as $key) {
            if (!empty($key->patient->inputoutput->first()->inside_office) && !empty($key->patient->inputoutput->first()->inside) && !empty($key->patient->inputoutput->first()->outside_office)){
               return $atendidos->push($key);
            }
        }
        
        View::share('citasDelDia', $day->count()); 
        View::share('atendidos', $atendidos->count()); 
        
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Carbon\Carbon;
use App\Reservation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
                $atendidos->push($key);
            }
        }

        // $atendidos = $day->map(function ($item, $key) {
        //     if (!empty($item->patient->inputoutput->first()->inside_office) && !empty($item->patient->inputoutput->first()->inside) && !empty($item->patient->inputoutput->first()->outside_office)){
        //         return $item;
        //     }else{

        //     }
        // });

        // dd($atendidos);
        
        
        View::share('citasDelDia', $day->count()); 
        View::share('atendidos', $atendidos->count());  
    }
}

<?php

namespace App\Listeners;

use App\Events\Consult;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Outside
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Consult  $event
     * @return void
     */
    public function handle(Consult $event)
    {
        //
    }
}

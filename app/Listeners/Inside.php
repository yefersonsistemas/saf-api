<?php

namespace App\Listeners;

use App\Events\Security;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Inside
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
     * @param  Security  $event
     * @return void
     */
    public function handle(Security $event) //accede al paciente enviado desde el evento security
    {
        $event->$patients;
    }
}

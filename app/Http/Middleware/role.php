<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if (!Auth::check()) // verifica si esta autorizado el usuario
        return redirect('login');

    $user = Auth::user();  

    if($user->isAdmin())
        return $next($request);

    foreach($roles as $role) {
        if($user->hasRole($role))  //verifica si el usuario tienen el rol
            return $next($request);
    }

    return redirect('login');
    }
}

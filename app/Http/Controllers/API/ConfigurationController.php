<?php

namespace App\Http\Controllers;

use App\User;
use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\updatePersonalDatesRequest;
use Carbon\Carbon;


class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user      = Auth::user();
        // dd($user->roles()->pluck('name')->first());
        $doctors   = User::role('doctor')->get();
        return view('dashboard.configuration.personal', compact('user','doctors'));
    }

    public function dolarPrice()
    {
        $doctors   = User::role('doctor')->get();
        $price = Configuration::where('name','price_usd')->first();
        return view('dashboard.configuration.dolar', compact('price','doctors'));
    }

    public function dolarUpdate(Request $request, Configuration $dolar)
    {
        $dolar->update([
            'value' => $request->price,
        ]);

        return redirect()->route('configuration.dolar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function personalUpdate(updatePersonalDatesRequest $request, User $user)
    {
        // Validacion de datos
        $data = $request->validated();
        // Verifica el email
        if ($user->email != $data['email']) {
            $user->email = $data['email'];
            $user->email_verified_at = now();
        }

        //Verifica la contraseña
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        // Actualizando el usuario
        $user->name     = $data['name'];
        $user->lastname = $data['lastname'];
        $user->birthdate = $request->birthdate;
        $user->gender    = $request->gender;
        $user->phone     = $request->phone;
        $user->save();
        return redirect()->route('configuration.index',$user);

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function updateUserPassword(Request $request, Configuration $configuration)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}

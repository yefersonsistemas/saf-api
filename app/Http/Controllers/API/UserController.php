<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function register(UserRegisterRequest $request)
    {
        $person = Person::where('email', $request->email)->first();   
        
        if ($person && $person->users->password != null) {
            return $this->authForSocial($user); // Login
        } elseif ($request->password == null) {
            
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            //llamamos y llenamos tabla persona para asociarla con user
            $person = Person::create([
                'type_dni'          => $request->type_dni,
                'dni'               => $request->dni,
                'name'              => $request->name,
                'lastname'          => $request->lastname,
                'address'           => $request->address,
                'phone'             => $request->phone,
                'email'             => $request->email,
            ]);

            $user = User::create([
                'person_id'    => $person->id,
                'password'     => Hash::make($request->password),
            ]);
          
            $user->assignRole('User');

            return $this->authForSocial($user); // Login
        }

        return response()->json([
            'message' => 'Usuario creado correctamente!',
        ], 201);
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $user = User::whereEmail($request->email)->firstOrFail();

            if ($user->password == null) {
                return response()->json(['message' => 'Usted no puede entrar con email y contraseña']);
            }
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'No autorizado'], 401);
            }
            $user        = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token       = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeek(2);
            }
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse(
                    $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function authForSocial(User $user)
    {
        $tokenResult       = $user->createToken('Personal Access Token');
        $token             = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeek(2);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        return $request->user()->token();
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Se desconectó con éxito',
        ]);
    }
}
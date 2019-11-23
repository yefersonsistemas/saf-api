<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Person;
Use App\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

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
        $person = Person::where('email', $request->email)->first();  //buscamos en person el email correspondiente 
        $user = User::where('password', $request->password)->first();
        
        if ($person->email && $user->password != null) { //verificamos si email y password continen algun valor
            return $this->authForSocial($user); // Login  en caso de si tener un valor verifica el token para accceder
        } elseif ($request->password == null) { //caso contrario creamos un nuevo usuario con sus datos.
            $person = Person::create([ //llamamos y llenamos tabla persona para asociarla con user
                'type_dni'    => $request->type_dni,
                'dni'         => $request->dni,
                'name'        => $request->name,
                'lastname'    => $request->lastname,
                'address'     => $request->address,
                'phone'       => $request->phone,
                'email'       => $request->email,
            ]);

            $user = User::create([ //llamamos y llenamos tabla user con id_person que trae todo de person
                'person_id'    => $person->id,
                'password'     => Hash::make($request->password),
            ]);
          
            $user->assignRole('User'); //asignamos role al usuario

            return $this->authForSocial($user); // Login  verifica el token para accceder
        }

        return response()->json([
            'message' => 'Usuario creado correctamente!',
        ], 201);
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $person = Person::whereEmail($request->email)->firstOrFail(); //obtengo el usuario por el email
            $user = User::where('password', $request->password)->firstOrFail();

            if ($user->password == null) { //verifico si el password corrresponde a el email encontrado
                return response()->json(['message' => 'Usted no puede entrar con email y contraseña']);
            }
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {//si el intento de autenticacion es incorrecto
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

    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
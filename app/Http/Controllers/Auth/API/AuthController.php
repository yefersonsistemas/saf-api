<?php
namespace App\Http\Controllers\Auth\Api;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Person;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class AuthController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return string
     */
    public function register(Request $request)
    {
        $user = Person::where('email', $request->email)->with('user')->first();
        if ($user != null) {
            return response()->json([
                'message' => 'Usuario ya se encuentra registrado!',
            ], 201);        
        }

        $branch = Branch::where('id', 1)->first();

        // En caso de que no exista creamos un nuevo usuario con sus datos.
        $person = Person::create([
            'type_dni' => $request->type_dni, 
            'dni'      => $request->dni,
            'name'     => $request->name,
            'lastname' => $request->last_name,
            'email'    => $request->email,
            'address'  => $request->address,
            'phone'    => $request->phone,
            'branch_id' => $branch->id,
        ]);

        $user = User::create([
            'person_id' => $person->id,
            'password' => Hash::make($request->password),
            'branch_id' => $branch->id,
        ]);

        $user->assignRole('user');

        return response()->json([
            'message' => 'Usuario creado correctamente.!',
        ], 201);
    }

    /**
     * Authenticate the user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $user = Person::whereEmail($request->email)->first();
            if ($user == null) {
                return response()->json([
                    'message' => 'Usuario no registrado'], 401);
            }
            
            $user1 = User::where('person_id',$user->id)->first();
            
            if (!Hash::check($request->password, $user1->password)) {
                return response()->json([
                    'message' => 'Contraseña incorrecta'], 401);
            }

            $tokenResult = $user->user->createToken('Personal Access Token');
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
                'role'         =>   $user->user->getRoleNames(),
                'message'      => 'Sesion Iniciada',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
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

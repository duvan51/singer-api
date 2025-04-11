<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;


class UserController extends Controller
{
    
    public function store(Request $request) {
        $validator = Validator::make( $request->all(), [
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_picture' => 'nullable|string',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al validar los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'profile_picture' => $request->profile_picture,
            ]);
    
            return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201);

        } catch(\Exception $e){
            return response()->json([
                'message' => 'Error guardando la categoría',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
       
    
    }

    public function show($id){
        $user = User::find($id);
        if(!$user){
            $data = [
                'message' => 'user not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($user, 200);
    }
    


    
    public function index(){
        $users = User::all();
        if($users->isEmpty()){
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($users, 200);
    }





    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    /*
    // Debug: Mostrar contraseñas
    return response()->json([
        'input_password' => $request->password,
        'stored_password' => $user->password,
        'hash_check' => Hash::check($request->password, $user->password)
    ]);
     
    */
    }
    

}
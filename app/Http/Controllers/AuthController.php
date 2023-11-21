<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class AuthController extends Controller
{
 //Crear usuario pidiendo su rol
 public function formRegister(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'name' => 'required | string | max:100',
         'lastname' => 'required | string | max:200',
         'mat' => 'required | string | max:10',
         'rol_id' => 'required',
         'edad' => 'required',
         'sexo' => 'required',
         'email' => 'required | string | email | unique:users',
         'password' => 'required | string | min:8'
     ]);

     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 422);
     }


     $user = User::create([
         'name' => $request->name,
         'lastname' => $request->lastname,
         'edad' => $request->edad,
         'sexo' => $request->sexo,
         'mat' => $request->mat,
         'rol_id' => $request->rol_id,
         'email' => $request->email,
         'password' => bcrypt($request->password)
     ]);

     return response()->json(['user' => $user], 201);
 }


 //Iniciar sesion con token
 public function startLogin(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'email' => 'required | string | email',
         'password' => 'required | string'
     ]);

     if ($validator->fails()) {
         return response()->json(['Error' => $validator->errors()], 422);
     }

     $credentials = $request->only(['email', 'password']);

     if (!Auth::attempt($credentials)) {
         return response()->json(['error' => 'No autorizado'], 401);
     }

     $user = $request->user();
     $token = $user->createToken('auth-token')->plainTextToken;

     return response()->json(['Token' => $token, 'Usuario' => $user, 'AccessToken' => $token], 200);
 }


 //Cerrar sesion

 public function endLogin()
 {
     auth()->user()->tokens()->delete();
     return response()->json([
         'status' => true,
         'message' => 'User logged out successfully'
     ], 200);
 }

 //Crear un administrador y que agregue su rol por defecto
 public function addAdmin(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:100',
         'lastname' => 'required|string|max:200',
         'mat' => 'required|string|max:10',
         'edad' => 'required',
         'sexo' => 'required',
         'email' => 'required|string|email|unique:users',
         'password' => 'required|string|min:8'
     ]);

     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 422);
     }

     $user = User::create([
         'name' => $request->name,
         'lastname' => $request->lastname,
         'edad' => $request->edad,
         'sexo' => $request->sexo,
         'mat' => $request->mat,
         'rol_id' => 1,
         'email' => $request->email,
         'password' => bcrypt($request->password)
     ]);

     return response()->json(['user' => $user], 201);
 }


 


 //Crear un estudiante y que agregue su rol por defecto
 public function addStudent(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:100',
         'lastname' => 'required|string|max:200',
         'mat' => 'required|string|max:10',
         'edad' => 'required',
         'sexo' => 'required',
         'email' => 'required|string|email|unique:users',
         'password' => 'required|string|min:8'
     ]);

     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 422);
     }

     $user = User::create([
         'name' => $request->name,
         'lastname' => $request->lastname,
         'edad' => $request->edad,
         'sexo' => $request->sexo,
         'mat' => $request->mat,
         'rol_id' => 3,
         'email' => $request->email,
         'password' => bcrypt($request->password)
     ]);

     return response()->json(['user' => $user], 201);
 }
}

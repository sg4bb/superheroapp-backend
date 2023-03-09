<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'rol' => $request->input('rol')
            ]);


            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token ], 200
            );

        } catch (\Exception $err) {
            return response() -> json([
                'error' => $err->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ]);
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', '=', $request->input('email'))->firstOrFail();

            if (Hash::check($request->input('password'), $user->password))
            {
                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json([
                    'user' => $user,
                    'token' => $token ], 200
                );
            }

            return response()->json([
                'message' => 'Estas credenciales no coinciden con nuestros registros.'
            ], 400);

        } catch (\Exception $err) {
            return response() -> json([
                'error' => $err->getMessage(),
                'message' => 'Estas credenciales no coinciden con nuestros registros.'
            ], 400);
        }
    }


    public function logout(LogoutRequest $request)
    {
        try {
            $user = User::findOrFail($request->input('user_id'));

            $user->tokens()->delete();

            return response()->json('User logged out', 200);

        } catch (\Exception $err) {
            return response() -> json([
                'error' => $err->getMessage(),
                'message' => 'Something went wrong in AuthController.logout'
            ]);
        }
    }
}

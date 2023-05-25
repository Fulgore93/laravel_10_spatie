<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request){
        try {
            $validator = $request->validate([
                'usu_email' => 'email|required',
                'password' => 'required'
            ]);

            if (!auth()->attempt($validator)) {
                return response()->json([
                    'success' => false,
                    'data'    => 'Error',
                    'message' => 'Unauthorised'
                ], 401);
            } else {
                $Usuario = Usuario::where('usu_email', $request->usu_email)->first();
                $Usuario->tokens()->delete();
                return response()->json([
                    'success' => true,
                    'data'    => $Usuario->createToken("token")->plainTextToken,
                    'message' => 'Usuario Logged In Successfully',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data'    => 'Error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

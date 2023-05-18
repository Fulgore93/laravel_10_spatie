<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = array(
            'usu_email'   => $request->email,
            'password'    => $request->password
        );

        if (!Auth::attempt($user)){
            throw ValidationException::withMessages([
                'email'             => 'Incorrect username and/or password',
                'password'          => 'Incorrect username and/or password',
            ]);
        }else {
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}

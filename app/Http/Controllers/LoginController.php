<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function authenticate(Request $request)
    {
        if (env('PASSWORD_LOGIN_ENABLED', false)) {
            $credentials = $request->only("email", "password");
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return auth()->user();
            }
        }
        return response()->json(["error" => "The provided credentials do not match our records."], 400);
    }

    public function check()
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return response()->json(["error" => "No active session"], 400);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response(200);
    }
}

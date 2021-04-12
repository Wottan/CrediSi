<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteLoginController extends Controller
{

    public function redirectToLogin(Request $request)
    {
        return Socialite::driver($request->driver ?? 'google')->redirect();
    }

    public function redirectToHome(Request $request, User $user){
        $oauthUser = Socialite::driver($request->driver ?? 'google')->user();
        Auth::login($user->firstOrCreate(
            ["email" => $oauthUser->getEmail()],
            [
                "name" => $oauthUser->getName(),
                "password" => Hash::make(Str::random(8))
            ]
        ), true);
        return redirect()->route("home");
    }
}

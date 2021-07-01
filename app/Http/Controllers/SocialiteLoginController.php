<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{

    public function redirectToLogin(Request $request)
    {
        return Socialite::driver($request->driver ?? 'google')->redirect();
    }

    public function redirectToHome(Request $request)
    {
        $oauthUser = Socialite::driver($request->driver ?? 'google')->user();
        $email = $oauthUser->getEmail();
        if (str_contains($email, "@".env("AUTHORIZED_LOGIN_DOMAIN"))) {
            $user = User::firstOrNew(["email" => $email]);
            if ($user->isDirty()) {
                Log::info("Created user $email by google login");
                $user->name = $oauthUser->getName();
                $user->password = Hash::make(Str::random(8));
                $user->email_verified_at = Carbon::now();
                $user->save();
            }
            if($user->can_login) {
                Auth::login($user, true);
                return redirect()->to("/home");
            } else {
                Log::warning("User $email has no login permission");
            }
        } 
        
        return redirect()->to("/login");
    }
}

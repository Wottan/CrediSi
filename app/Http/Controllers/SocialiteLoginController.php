<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $user = User::firstOrNew(["email" => $email]);
        if ($user->isDirty()) {
            Log::info("Created user $email by google login");
            $user->name = $oauthUser->getName();
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
        if ($user->can_login) {
            Auth::login($user, true);
            return redirect()->to("/");
        } else {
            return redirect()->route("login", ["error" => "User $email has no login permission"]);
        }
    }
}

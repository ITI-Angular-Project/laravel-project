<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('linkedin-openid')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $linkedinUser = Socialite::driver('linkedin-openid')->user();

        $user = User::firstOrCreate([
            'email' => $linkedinUser->getEmail(),
        ], [
            'name' => $linkedinUser->getName(),
            'linkedin_id' => $linkedinUser->getId(),
            'avatar' => $linkedinUser->getAvatar(),
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt(Str::random(16)),
        ]);

        Auth::login($user);

        return redirect()->intended(route('home'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\SubscriptionService;

class SocialController extends Controller
{
    // GOOGLE REDIRECT
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // GOOGLE CALLBACK
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt('random_password')
            ]
        );
        
        if(!$user->subscription){
            SubscriptionService::assignFreePlan($user);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }

    // GITHUB REDIRECT
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // GITHUB CALLBACK
    public function handleGithubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'github_id' => $githubUser->getId(),
                'avatar' => $githubUser->getAvatar(),
                'password' => bcrypt('random_password')
            ]
        );

        if(!$user->subscription){
            SubscriptionService::assignFreePlan($user);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}

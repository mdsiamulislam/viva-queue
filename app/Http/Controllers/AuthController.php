<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function googleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // allowed email
        $staticEmail = 'soaib.softdev@gmail.com, mazhar@iom.edu.bd';

        if ($googleUser->getEmail() !== $staticEmail) {
            return redirect()->route('login')->with('error', 'Unauthorized email address');
        }

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name'  => $googleUser->getName(),
                'password' => bcrypt('temporarypassword'),
            ]
        );

        Auth::login($user, true); // session persist

        return redirect()->route('dashboard');
    }
}

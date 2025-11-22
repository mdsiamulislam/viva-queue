<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// class AuthController extends Controller
// {
//     public function googleCallback()
//     {
//         $googleUser = Socialite::driver('google')->user();

//         // Google থেকে email পেলাম
//         $email = $googleUser->getEmail();

//         // Database এ user আছে কিনা চেক
//         $user = User::where('email', $email)->first();

//         if (!$user) {
//             // তুমি চাইলে redirect করে দিতে পারো: “Account not found”
//             return redirect('/login')->with('error', 'No user found with this email');
//         }

//         // Login success
//         Auth::login($user);

//         return redirect('/dashboard');
//     }
// }


class AuthController extends Controller
{
    public function googleCallback()
    {
        // Google user info
        $googleUser = Socialite::driver('google')->user();

        // === STATIC USER LOGIN (temporal / testing purpose) === //

        // Static user email (your choice)
        $staticEmail = 'soaib.softdev@gmail.com';

        // যদি database এ না থাকে → auto create করে দেবে
        $user = User::firstOrCreate(
            ['email' => $staticEmail],
            [
                'name' => 'Static Demo User',
                'password' => bcrypt('demo123') // Just a default password (unused)
            ]
        );

        // Direct login
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Static user logged in');
    }
}

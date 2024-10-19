<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteProviderController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        $user = Socialite::driver($provider)->user();

        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            Auth::login($existingUser);
            return redirect()->route('dashboard')->with('success', "Login Successfull");
        }else{
            $getUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->avatar,
                'password' => Hash::make('the_global_password.@345'),
                'role' => 'admin',
                'attempt_role' => 'third_party',
                'email_verified_at' => now(),
                'created_at' => now(),
            ]);
            Auth::login($getUser);
            return redirect()->route('dashboard')->with('success', "Login Successfull");


        }

    }

}

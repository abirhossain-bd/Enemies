<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestAuthenticationController extends Controller
{
    public function register(){
        return view('frontend.auth.register');
    }
    public function register_post(Request $request){
        $request->validate([
            '*'=>'required',
        ]);

        $existUser = User::where('email',$request->email)->first();
        if($existUser){
            return redirect()->back()->with('error','This email is already registered!');
        }
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'created_at' => now(),
        ]);
        return redirect()->route('guest.login')->with('success','Registration Completed Successfully!');
    }



    public function login(){
        return view('frontend.auth.login');
    }


    public function login_post(Request $request){
        $request->validate([
            '*'=>'required',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error','Credential Does not match! ');
        }
    }
}

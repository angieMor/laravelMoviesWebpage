<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function showSigninWebpage(){
        # Validates if theres an active session, and redirect the user to the netflix url
        if(Auth::check()){
            return redirect('netflix');
        }
        # Otherwise, It'll tell the user to Register
        return view('signin');
    }

    # Register the user
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'password' => 'required|string',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->role = "USER_ROLE";
        $user->email= $request->email;
        $user->password= $request->password;

        $user->save();

        return redirect()->route('login')->with('registered', 'Saved');
    }
}

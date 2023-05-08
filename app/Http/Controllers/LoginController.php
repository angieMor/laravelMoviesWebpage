<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginWebpage(){
        # Validates if theres an active session, and redirect the user to the netflix url
        if(Auth::check()){
            return redirect('netflix');
        }
        # Otherwise, It'll tell the user to Login
        return view('login');
    }

    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Intento de autenticación del usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Autenticación exitosa, redirigir al usuario a la página de inicio
            return redirect()->intended('netflix');
        }

        // Autenticación fallida, devolver al formulario de inicio de sesión con un error
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect()->to('/login');
    }
}

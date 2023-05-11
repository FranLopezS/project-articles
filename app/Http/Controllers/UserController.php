<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request) {
        $credentials =$request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // echo "1 ";
        // $user = User::where('email', $request->email)->first();
        // if(!isset($user->email)) return; // Usuario no existe.
        // echo "2 ";
        // if(!Hash::check($request->password, $user->password)) return; // Contraseña incorrecta.

        // $request->session()->put('user_id', $user->user_id);
        // $request->session()->put('name', $user->email);
        // $request->session()->put('email', $user->user_id);
        // echo "5 ";
        // $credentials = [
        //     'email' => session('email'),
        //     'password' => $request->password
        // ];

        if(Auth::attemp($credentials)) {
            $request->session()->regenerate();
            echo "4 ";
            return redirect('/')->with('status-success', '¡Sesión iniciada correctamente!');
        }

        echo "3 ";
        return redirect('/')->with('status-error', '¡Error al iniciar sesión!');
    }

    public function signOut() {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}

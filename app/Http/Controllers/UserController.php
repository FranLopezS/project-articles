<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if(Auth::attempt($credentials))
            {
                $request->session()->put('email', $request->email);
                $request->session()->regenerate();
                return response()->json(['¡Sesión iniciada correctamente!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['¡Error al iniciar sesión!']);
        }
        
        return response()->json(['¡Credenciales incorrectas!']);
    }

    public function signOut(Request $request) {
        try {
            Auth::logout();
 
            $request->session()->invalidate();
     
            $request->session()->regenerateToken();
     
            return response()->json(['¡Sesión cerrada correctamente!']);
        } catch (Throwable $th) {
            return response()->json(['¡Error al cerrar sesión!']);
        }
    }
}

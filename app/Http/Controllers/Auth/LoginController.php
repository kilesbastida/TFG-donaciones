<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar el formulario de inicio de sesión
    public function login(Request $request){
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar iniciar sesión
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            // Redirigir al usuario a la página principal home.blade.php
            return redirect()->route('home');
        }

        // Si la autenticación falla
        return back()->withErrors(['email' => 'Las credenciales no coinciden']);
    }

    //Cerrar sesión
    public function logout(Request $request)
    {
    Auth::logout();

    // Invalida la sesión y regenera el token CSRF por seguridad
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
    }
}


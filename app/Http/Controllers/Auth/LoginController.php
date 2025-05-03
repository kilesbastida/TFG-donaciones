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
        return view('login'); // Asegúrate de tener una vista login.blade.php
    }

    // Procesar el inicio de sesión
    public function login(Request $request){
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intentar iniciar sesión
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirigir al usuario a la página principal o al dashboard
            return redirect()->route('home');
        }

        // Si la autenticación falla
        return back()->withErrors(['email' => 'Las credenciales no coinciden']);
    }

    public function logout(Request $request)
    {
    Auth::logout();

    // Invalida la sesión y regenera el token CSRF por seguridad
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
    }
}


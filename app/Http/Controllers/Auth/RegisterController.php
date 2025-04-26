<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // Mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('registro'); // Esta es la vista del formulario
    }

    // Procesar los datos del formulario de registro
    public function register(Request $request)
    {
        // Validación de los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'transaction_type' => 'required|string|in:donacion,intercambio',
        ]);
    

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'location' => $request->location,
            'transaction_type' => $request->transaction_type,
        ]);

        // Loguear al usuario automáticamente después del registro
        Auth::login($user);

        // Redirigir al usuario a la vista de inicio (la que es tu página principal)
        return redirect('/');  // Cambié esto por la ruta de inicio
    }
}

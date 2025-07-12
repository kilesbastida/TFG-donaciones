<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Mostrar el perfil
    public function perfil()
    {
        $user = Auth::user();
        $ciudades = include resource_path('cities.php');  // cargar array de ciudades
        return view('profile.perfil', compact('user', 'ciudades'));
    }

    // Actualizar el perfil
    public function update(Request $request)
    {
        $user = Auth::user();
        $ciudades = include resource_path('cities.php'); 
        // Validación de los datos
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', 'regex:/@(gmail\.com|hotmail\.com|yahoo\.com|outlook\.com|icloud\.com)$/i', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:5', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'phone' => ['required', 'digits:9', Rule::unique('users', 'phone')->ignore($user->id)],
            'location' => ['required', 'string', 'max:255', Rule::in($ciudades)],
            'transaction_type' => ['nullable', 'in:donacion,intercambio,ambas'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Este nombre ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo debe ser una dirección válida.',
            'email.unique' => 'Este correo ya está en uso.',
            'email.regex' => 'El correo no tiene un formato válido.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits' => 'El teléfono debe tener exactamente 9 números.',
            'phone.unique' => 'Este teléfono ya está en uso.',
            'location.required' => 'La ubicación es obligatoria.',
            'location.in' => 'La ubicación debe ser una ciudad válida.',
            'transaction_type.in' => 'El tipo de transacción no es válido.',
        ]);


        // Actualizar nombre y email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->location = $request->location;
        $user->transaction_type = $request->transaction_type;

        // Actualizar la contraseña si es proporcionada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Subir la nueva imagen de perfil
        if ($request->hasFile('avatar')) {
            // Eliminar la imagen anterior si existe
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Subir la nueva imagen y obtener su ruta
            $imagePath = $request->file('avatar')->store('profile_images', 'public');
            $user->avatar = $imagePath;
        }


        // Guardar los cambios
        $user->save();

        return redirect()->route('home');
    }
}

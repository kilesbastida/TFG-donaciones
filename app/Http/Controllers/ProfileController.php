<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // Mostrar el perfil
    public function perfil()
    {
        $user = Auth::user();
        return view('profile.perfil', compact('user'));
    }

    // Actualizar el perfil
    public function update(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Actualizar nombre y email
        $user->name = $request->name;
        $user->email = $request->email;

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

        return redirect()->route('profile.update')->with('success', 'Perfil actualizado correctamente.');
    }
}

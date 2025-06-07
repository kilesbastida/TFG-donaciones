<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function isAdmin()
    {
        return auth()->check() && auth()->user()->admin;
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            abort(403, 'No autorizado.');
        }

        // Obtener todos los usuarios (o ajusta la consulta si quieres)
        $users = User::all();

        return view('admin.userlist', compact('users'));
    }

    public function edit($id)
    {
        if (!$this->isAdmin()) {
            abort(403, 'No autorizado.');
        }

        $user = User::findOrFail($id);

        return view('admin.useredit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!$this->isAdmin()) {
            abort(403, 'No autorizado.');
        }

        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'admin' => 'sometimes|boolean',
        ]);

        $user->update($data);

        return redirect()->route('admin.userlist')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (!$this->isAdmin()) {
            abort(403, 'No autorizado.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.userlist')->with('success', 'Usuario eliminado correctamente.');
    }
}

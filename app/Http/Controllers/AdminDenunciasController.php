<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use Illuminate\Http\Request;

class AdminDenunciasController extends Controller
{
    public function activas()
    {
        $denuncias = Denuncia::where('estado', 'pendiente')->latest()->get();
        return view('admin.denunciasactivas', compact('denuncias'));
    }

    public function historial()
    {
        $denuncias = Denuncia::where('estado', 'resuelta')->latest()->get();
        return view('admin.denunciashistorial', compact('denuncias'));
    }

    // Cambiado de formResolver a showDenuncia
    public function showDenuncia($id)
    {
        $denuncia = Denuncia::findOrFail($id);

        if ($denuncia->estado === 'resuelta') {
            return redirect()->route('admin.denuncias.activas');
        }

        return view('admin.showdenuncia', compact('denuncia'));
    }

    // Cambiado de resolver a guardarResolucion
    public function guardarResolucion(Request $request, $id)
    {
        $request->validate([
            'resolucion' => 'required|string|min:5',
        ]);

        $denuncia = Denuncia::findOrFail($id);
        $denuncia->estado = 'resuelta';
        $denuncia->resolucion = $request->resolucion;
        $denuncia->save();

        return redirect()->route('admin.denuncias.activas');
    }
}

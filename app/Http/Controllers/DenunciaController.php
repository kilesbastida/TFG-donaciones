<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DenunciaController extends Controller
{
    // Mostrar formulario para denunciar un producto
    public function crearProducto($productoId)
    {
        $producto = Product::findOrFail($productoId);
        return view('denuncias.producto', compact('producto'));
    }

    // Guardar denuncia producto
    public function guardarProducto(Request $request, $productoId)
    {
        $request->validate([
            'razon' => 'required|in:contenido_inapropiado,fraude,acoso,otro',
            'descripcion' => 'required|string|max:2000',
        ]);

        $producto = Product::findOrFail($productoId);

        Denuncia::create([
            'producto_id' => $producto->id,
            'denunciante_id' => Auth::id(),
            'denunciado_id' => $producto->user,
            'razon' => $request->razon,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('productos.stock');
    }

    // Mostrar formulario para denunciar a un usuario
    public function crearUsuario($usuarioId)
    {
        $usuario = User::findOrFail($usuarioId);
        return view('denuncias.usuario', compact('usuario'));
    }

    // Guardar denuncia usuario
    public function guardarUsuario(Request $request, $usuarioId)
    {
        $request->validate([
            'razon' => 'required|in:contenido_inapropiado,fraude,acoso,otro',
            'descripcion' => 'required|string|max:2000',
        ]);

        $usuario = User::findOrFail($usuarioId);

        Denuncia::create([
            'producto_id' => null,
            'denunciante_id' => Auth::id(),
            'denunciado_id' => $usuario->id,
            'razon' => $request->razon,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('home');
    }

    // Aquí podrías agregar métodos para listar denuncias y que el admin pueda resolverlas, etc.
}

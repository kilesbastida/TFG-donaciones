<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
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

        $productos = Product::latest()->get();
        return view('admin.productlist', compact('productos'));
    }

    public function show($id)
    {
        if (!$this->isAdmin()) {
            abort(403, 'No autorizado.');
        }

        $producto = Product::with('usuario')->findOrFail($id);
        return view('admin.productshow', compact('producto'));
    }

    public function destroy($id)
    {
        if (!$this->isAdmin()) {
            abort(403, 'No autorizado.');
        }

        $producto = Product::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productlist')->with('success', 'Producto eliminado correctamente.');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    public function stock(Request $request)
    {
        $query = Product::query();

        if ($request->has('transaction_type') && $request->transaction_type != '') {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->has('location') && $request->location != '') {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }

        $productos = $query->latest()->get();
        return view('productos.stock', compact('productos'));
    }

    public function personales()
    {
        $productos = Product::where('user', Auth::id())->get();
        return view('productos.personales', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'estado' => 'required|in:nuevo,buen_estado,lo_ha_dado_todo',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'transaction_type' => 'required|in:donacion,intercambio,ambas',
        ]);

        $path = $request->file('image')->store('product_images', 'public');

        Product::create([
            'user' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'estado' => $request->estado,
            'transaction_type' => $request->transaction_type,
            'location' => Auth::user()->location,
            'image' => $path,
        ]);

        return redirect()->route('productos.stock')->with('success', 'Producto creado correctamente.');
    }
}

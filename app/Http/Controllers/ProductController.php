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

    public function show($id)
    {
        $producto = Product::findOrFail($id);
        return view('productos.show', compact('producto'));
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

    public function edit($id)
    {
        $producto = Product::where('id', $id)->where('user', Auth::id())->firstOrFail();
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Product::where('id', $id)->where('user', Auth::id())->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'estado' => 'required|in:nuevo,buen_estado,lo_ha_dado_todo',
            'transaction_type' => 'required|in:donacion,intercambio,ambas',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $producto->image = $path;
        }

        $producto->title = $request->title;
        $producto->description = $request->description;
        $producto->estado = $request->estado;
        $producto->transaction_type = $request->transaction_type;
        $producto->save();

        return redirect()->route('productos.personales')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Product::where('id', $id)->where('user', Auth::id())->firstOrFail();
        $producto->delete();

        return redirect()->route('productos.personales')->with('success', 'Producto eliminado correctamente.');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Categoria;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function stock(Request $request)
    {
        $query = Product::where('comprado', false);

        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        if ($request->filled('location')) {
            $locations = (array) $request->location;

            if (!in_array('all', $locations)) {
                $query->whereIn('location', $locations);
            }
            // Si 'all' está en las ubicaciones, no aplicar filtro por ubicación.
        }


        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->filled('categoria')) {
            $categorias = (array) $request->categoria;

            if (!in_array('all', $categorias)) {
                $query->whereIn('categoria_id', $categorias);
            }
        }

        $productos = $query->latest()->get();
        $ciudades = include resource_path('cities.php');
        return view('productos.stock', compact('productos', 'ciudades'));
    }

    public function show($id)
    {
        $producto = Product::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function personales()
    {
        $productos = Product::where('user', Auth::id())->where('comprado', false)->get();
        return view('productos.personales', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $ciudades = include resource_path('cities.php');
        return view('productos.create', compact('categorias', 'ciudades'));
    }

    public function store(Request $request)
    {
        $ciudades = include resource_path('cities.php');
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'estado' => 'required|in:Nuevo,Buen estado,Lo ha dado todo',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'transaction_type' => 'required|in:donacion,intercambio,ambas',
            'location' => ['required', 'string', 'max:255', Rule::in($ciudades)],
            'categoria_id' => ['required', 'integer', Rule::exists('categorias', 'id')],
        ]);

        $path = $request->file('image')->store('product_images', 'public');

        Product::create([
            'user' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'estado' => $request->estado,
            'categoria_id' => $request->categoria_id,
            'transaction_type' => $request->transaction_type,
            'location' => $request->location,
            'image' => $path,
        ]);

        return redirect()->route('productos.stock');
    }

    public function edit($id)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $ciudades = include resource_path('cities.php');
        $producto = Product::where('id', $id)->where('user', Auth::id())->firstOrFail();
        return view('productos.edit', compact('producto','categorias','ciudades'));
    }

    public function update(Request $request, $id)
    {
        $producto = Product::where('id', $id)->where('user', Auth::id())->firstOrFail();
        $ciudades = include resource_path('cities.php');
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'estado' => 'required|in:Nuevo,Buen estado,Lo ha dado todo',
            'transaction_type' => 'required|in:donacion,intercambio,ambas',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => ['required', 'string', 'max:255', Rule::in($ciudades)],
            'categoria_id' => ['required', 'integer', Rule::exists('categorias', 'id')],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $producto->image = $path;
        }

        $producto->title = $request->title;
        $producto->description = $request->description;
        $producto->estado = $request->estado;
        $producto->categoria_id = $request->categoria_id;
        $producto->transaction_type = $request->transaction_type;
        $producto->location = $request->location;
        $producto->save();

        return redirect()->route('productos.personales');
    }

    public function destroy($id)
    {
        $producto = Product::where('id', $id)->where('user', Auth::id())->firstOrFail();
        $producto->delete();

        return redirect()->route('productos.personales');
    }

    public function buscar(Request $request)
    {
        $ciudades = include resource_path('cities.php');
        $categorias = Categoria::orderBy('nombre')->get();
        return view('productos.buscar', [
        'ciudades' => $ciudades,
        'categorias' => $categorias,
        'filtros' => $request->only(['title', 'location', 'estado', 'transaction_type','categoria']),
        ]);
    }
}

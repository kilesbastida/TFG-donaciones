<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 px-4">

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Título --}}
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Título</label>
            <input type="text" name="title" value="{{ old('title', $producto->title) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Descripción</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $producto->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Estado --}}
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Estado</label>
            <select name="estado" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="nuevo" {{ $producto->estado == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                <option value="buen_estado" {{ $producto->estado == 'buen_estado' ? 'selected' : '' }}>Buen estado</option>
                <option value="lo_ha_dado_todo" {{ $producto->estado == 'lo_ha_dado_todo' ? 'selected' : '' }}>Lo ha dado todo</option>
            </select>
            @error('estado') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tipo de transacción --}}
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Tipo de transacción</label>
            <select name="transaction_type" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="donacion" {{ $producto->transaction_type == 'donacion' ? 'selected' : '' }}>Donación</option>
                <option value="intercambio" {{ $producto->transaction_type == 'intercambio' ? 'selected' : '' }}>Intercambio</option>
                <option value="ambas" {{ $producto->transaction_type == 'ambas' ? 'selected' : '' }}>Ambas</option>
            </select>
            @error('transaction_type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Imagen actual + input --}}
        <div class="mb-6">
            <label class="block text-gray-700 mb-1">Imagen actual</label>
            <img src="{{ asset('storage/' . $producto->image) }}" alt="Imagen actual"
                 class="w-40 h-40 object-cover rounded mb-2">
            <label class="block text-gray-700 mb-1">Cambiar imagen (opcional)</label>
            <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Botones --}}
        <div class="flex justify-between">
            <a href="{{ route('productos.personales') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow">
                Volver
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

</body>
</html>

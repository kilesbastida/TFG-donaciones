<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle del Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">

    <header class="p-3">
        <h1 class="text-3xl font-bold text-center text-white">Detalle del Producto</h1>
    </header>

    <main class="flex-grow container mx-auto px-4 py-5 max-w-3xl">

        <div class="p-5 text-white">
            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->title }}" class="w-full h-64 object-cover rounded mb-4 border-0">

            <h2 class="text-2xl font-bold mb-2">{{ $producto->title }}</h2>

            <ul class="mb-6 space-y-1">
                <li><strong>Descripción:</strong> {{ $producto->description }}</li>
                <li><strong>Estado:</strong> <span class="capitalize">{{ $producto->estado }}</span></li>
                <li><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</li>
                <li><strong>Tipo de Transacción:</strong> <span class="capitalize">{{ $producto->transaction_type }}</span></li>
                <li><strong>Ubicación:</strong> {{ $producto->location }}</li>
                <li><strong>Publicado por:</strong> {{ $producto->usuario->name ?? 'Usuario desconocido' }}</li>
            </ul>

            <div class="flex space-x-4">
                <a href="{{ route('admin.productlist') }}" class="flex-1 bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300">
                    Volver a la lista
                </a>

                <form action="{{ route('admin.productlist.destroy', $producto->id) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                        Eliminar producto
                    </button>
                </form>
            </div>
        </div>

    </main>

</body>
</html>

<!DOCTYPE html>
<html lang="es" x-data="{ open: false }" @keydown.escape="open = false">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle del Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">

    <header class="p-3">
        <h1 class="text-3xl font-bold text-center text-white">Detalle del producto</h1>
    </header>

    <main class="flex-grow container mx-auto px-4 py-5 max-w-3xl">

        <div class="p-5 text-white">

            <!-- Imagen pequeña, clicable -->
            <img 
                src="{{ asset('storage/' . $producto->image) }}" 
                alt="{{ $producto->title }}" 
                class="w-full h-64 object-cover rounded mb-4 border-0 cursor-pointer" 
                @click="open = true"
            >

            <h2 class="text-2xl font-bold mb-2">{{ $producto->title }}</h2>

            <ul class="mb-6 space-y-1">
                <li><strong>Descripción:</strong> {{ $producto->description }}</li>
                <li><strong>Estado:</strong> {{ $producto->estado }}</li>
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

    <!-- Modal imagen zoom -->
    <div 
        x-show="open" 
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
        @click.away="open = false"
        style="display: none;"
    >
        <div class="relative">
            <!-- Botón cerrar -->
            <button 
                @click="open = false" 
                class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-gray-300 focus:outline-none"
                aria-label="Cerrar"
            >&times;</button>

            <img 
                src="{{ asset('storage/' . $producto->image) }}" 
                alt="{{ $producto->title }}" 
                class="max-w-[90vw] max-h-[90vh] object-contain rounded shadow-lg"
            >
        </div>
    </div>

</body>
</html>

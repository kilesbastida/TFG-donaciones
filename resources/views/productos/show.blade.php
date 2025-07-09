<!DOCTYPE html>
<html lang="es" x-data="{ open: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle del Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen flex flex-col">

    <header class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 p-4">
        <h1 class="text-3xl font-bold text-center text-white">Detalle del Producto</h1>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow relative z-10">
            <img src="{{ asset('storage/' . $producto->image) }}" 
                alt="{{ $producto->title }}" 
                class="w-full h-64 object-cover rounded mb-6 cursor-pointer"
                @click="open = true"
            >

            <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $producto->title }}</h2>

            <p class="text-sm text-gray-600 mb-2"><strong>Descripción:</strong> {{ $producto->description }}</p>
            <p class="text-sm text-gray-600 mb-2"><strong>Estado:</strong> {{ $producto->estado }}</p>
            <p class="text-sm text-gray-600 mb-2"><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
            <p class="text-sm text-gray-600 mb-2"><strong>Tipo de transacción:</strong> <span class="capitalize">{{ $producto->transaction_type }}</span></p>
            <p class="text-sm text-gray-600 mb-2"><strong>Ubicación:</strong> {{ $producto->location }}</p>
            <p class="text-sm text-gray-600 mb-4"><strong>Publicado por:</strong> {{ $producto->usuario->name ?? 'Usuario desconocido' }}</p>

            <div class="flex flex-wrap gap-4 mt-6">
            @if($producto->user !== Auth::id())

                <form action="{{ route('solicitudes.enviar') }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                    <div class="inline-flex w-full mb-1">
                        @if($producto->transaction_type === 'ambas')
                            <select name="tipo" required
                                    class="rounded-l-md border-t border-l border-b border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 w-1/2">
                                <option value="" disabled selected>Tipo de transacción</option>
                                <option value="donacion">Donación</option>
                                <option value="intercambio">Intercambio</option>
                            </select>

                            <button type="submit"
                                    class="rounded-r-md bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 transition w-1/2">
                                Enviar solicitud
                            </button>
                        @else
                            <input type="hidden" name="tipo" value="{{ $producto->transaction_type }}">
                            <button type="submit"
                                    class="w-full rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 transition">
                                Solicitar {{ $producto->transaction_type === 'donacion' ? 'donación' : 'intercambio' }}
                            </button>
                        @endif
                    </div>
                </form>

                <div class="grid grid-cols-3 gap-4 w-full">
                    <form action="{{ route('chat.iniciar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $producto->user }}">
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                            Enviar mensaje
                        </button>
                    </form>

                    <form action="{{ route('denuncia.producto', $producto->id) }}" method="GET">
                        <button type="submit" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                            Denunciar
                        </button>
                    </form>

                    <a href="{{ route('productos.stock') }}" 
                    class="w-full block text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded transition">
                        Volver al catálogo
                    </a>
                </div>
            @else
                <div class="w-full mt-6">
                    <a href="{{ route('productos.stock') }}"
                    class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-4 rounded transition">
                        Volver al catálogo
                    </a>
                </div>
            @endif
            </div>
        </div>
    </main>

    <!-- Modal para mostrar imagen en grande -->
    <div 
        x-show="open"
        x-transition 
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
        @click.away="open = false"
        style="display: none;"
    >
        <div class="relative">
            <button 
                @click="open = false"
                class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-gray-300"
                aria-label="Cerrar"
            >&times;</button>

            <img src="{{ asset('storage/' . $producto->image) }}" 
                 alt="{{ $producto->title }}" 
                 class="max-w-[90vw] max-h-[90vh] object-contain rounded shadow-lg"
            >
        </div>
    </div>

</body>
</html>

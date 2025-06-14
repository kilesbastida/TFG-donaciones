<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle del Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <header class="bg-white shadow p-4">
        <h1 class="text-3xl font-bold text-center text-gray-800">Detalle del Producto</h1>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->title }}" class="w-full h-64 object-cover rounded mb-6">

            <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $producto->title }}</h2>

            <p class="text-gray-700 mb-4">{{ $producto->description }}</p>

            <p class="text-sm text-gray-600 mb-2">
                Estado: <span class="capitalize font-medium">{{ str_replace('_', ' ', $producto->estado) }}</span>
            </p>

            <p class="text-sm text-gray-600 mb-4">
                Transacción: <span class="capitalize font-medium">{{ $producto->transaction_type }}</span>
            </p>

            <p class="text-sm text-gray-600 mb-4">
                Publicado por: 
                <span class="font-medium">
                    {{ $producto->user === Auth::id() ? 'Tú' : 'Otro usuario' }}
                </span>
            </p>

            <div class="flex flex-wrap gap-4 mt-6">
                @if($producto->user !== Auth::id())
                    <form action="{{ route('chat.iniciar') }}" method="POST" class="inline-block">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $producto->user }}">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                            Enviar mensaje
                        </button>
                    </form>

                    {{-- Botón para enviar solicitud --}}
                    <form action="{{ route('solicitudes.enviar') }}" method="POST" class="inline-block ml-2">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        
                        <select name="tipo" required
                                class="border rounded px-3 py-2 mr-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="" disabled selected>Tipo de solicitud</option>
                            <option value="donacion">Donación</option>
                            <option value="intercambio">Intercambio</option>
                        </select>

                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">
                            Enviar solicitud
                        </button>
                    </form>
                @endif


                <a href="{{ route('productos.stock') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded transition">
                    Volver al catálogo
                </a>
            </div>
        </div>
    </main>

</body>
</html>

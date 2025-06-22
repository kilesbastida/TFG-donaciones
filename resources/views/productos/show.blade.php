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
                    {{ $producto->usuario->name ?? 'Usuario desconocido' }}
                </span>
            </p>

            {{-- Ubicación --}}
            <p class="text-sm text-gray-600 mb-4">
                Ubicación: <span class="font-medium">{{ $producto->location }}</span>
            </p>

            <div class="flex flex-wrap gap-4 mt-6">
            @if($producto->user !== Auth::id())

                {{-- 🔶 BOTÓN PRINCIPAL: Enviar solicitud --}}
                <form action="{{ route('solicitudes.enviar') }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                    <div class="inline-flex w-full mb-4">
                        @if($producto->transaction_type === 'ambas')
                            {{-- 🔸 Selector de tipo de transacción (solo si es "ambas") --}}
                            <select name="tipo" required
                                    class="rounded-l-md border-t border-l border-b border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 w-1/2">
                                <option value="" disabled selected>Tipo de transacción</option>
                                <option value="donacion">Donación</option>
                                <option value="intercambio">Intercambio</option>
                            </select>

                            {{-- 🔸 Botón para enviar la solicitud --}}
                            <button type="submit"
                                    class="rounded-r-md bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 transition w-1/2">
                                Enviar solicitud
                            </button>
                        @else
                            {{-- 🔸 Botón directo si es donación o intercambio --}}
                            <input type="hidden" name="tipo" value="{{ $producto->transaction_type }}">
                            <button type="submit"
                                    class="w-full rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 transition">
                                Solicitar {{ $producto->transaction_type === 'donacion' ? 'donación' : 'intercambio' }}
                            </button>
                        @endif
                    </div>
                </form>

                {{-- 🔽 BOTONES SECUNDARIOS: Repartidos en 3 columnas --}}
                <div class="grid grid-cols-3 gap-4 w-full">
                    {{-- 🔹 Botón para iniciar chat --}}
                    <form action="{{ route('chat.iniciar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $producto->user }}">
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                            Enviar mensaje
                        </button>
                    </form>

                    {{-- 🔹 Botón de denuncia --}}
                    <form action="{{ route('denuncia.producto', $producto->id) }}" method="GET">
                        <button type="submit" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                            Denunciar
                        </button>
                    </form>

                    {{-- 🔹 Botón para volver al catálogo --}}
                    <a href="{{ route('productos.stock') }}" 
                    class="w-full block text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded transition">
                        Volver al catálogo
                    </a>
                </div>
            @else
                {{-- ✅ BOTÓN DE VOLVER si el usuario es el publicador --}}
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

</body>
</html>

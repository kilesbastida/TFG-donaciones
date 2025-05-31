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
                    <a href="{{ route('chat.iniciar', $producto->user) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                        Enviar mensaje
                    </a>
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

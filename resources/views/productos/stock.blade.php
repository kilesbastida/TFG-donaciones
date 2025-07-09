<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Productos Disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500">

    <!-- Header fijo arriba con gradiente -->
    <header class="p-4 fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500">
        <div class="relative flex items-center justify-center">
            <!-- Título centrado -->
            <h1 class="text-3xl font-bold text-white">Productos</h1>

            <!-- Íconos flotantes a la derecha -->
            <div class="absolute right-0 flex items-center space-x-2">
                <a href="{{ route('productos.buscar', request()->only(['title', 'location', 'estado', 'transaction_type','categoria'])) }}" title="Buscar productos" class="text-white hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </a>

                @if(request()->hasAny(['title', 'location', 'estado', 'transaction_type']))
                    <a href="{{ route('productos.stock') }}" title="Eliminar filtros" class="text-white hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Main: scroll en artículos -->
    <main class="flex-grow overflow-y-auto container mx-auto px-4 py-6" style="margin-top: 72px; margin-bottom: 72px;">
        @if(session('success'))
            <div class="mb-6 max-w-xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($productos->isEmpty())
            <div class="flex flex-col items-center justify-center h-[60vh] text-white text-xl font-semibold">
                Actualmente no hay ningún producto
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($productos as $producto)
                    <a href="{{ route('productos.show', $producto->id) }}" class="bg-white rounded-lg shadow p-4 flex flex-col transition hover:shadow-lg hover:-translate-y-1 duration-200">
                        <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->title }}" class="w-full h-48 object-cover rounded mb-4">
                        <h2 class="text-lg font-semibold mb-2 truncate text-gray-800">{{ $producto->title }}</h2>
                        <p class="text-gray-500 text-sm capitalize">Transacción: {{ $producto->transaction_type }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer fijo abajo con gradiente -->
    <footer class="shadow p-4 sticky bottom-0 z-50 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500">
        <div class="max-w-xl mx-auto flex justify-center space-x-4">
            <a href="{{ route('productos.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Añadir producto
            </a>
            <a href="{{ route('productos.personales') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Ver mis productos
            </a>
            <a href="{{ route('home') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300"> 
                Volver
            </a>
        </div>
    </footer>

</body>
</html>

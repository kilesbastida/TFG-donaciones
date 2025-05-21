<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Productos Disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex flex-col">


    <header class="bg-white p-4">
        <h1 class="text-3xl font-bold text-center text-gray-800">Productos</h1>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">

        @if(session('success'))
            <div class="mb-6 max-w-xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($productos->isEmpty())
            <div class="flex flex-col items-center justify-center h-[60vh] text-gray-700 text-xl font-semibold">
                Actualmente no hay ningún producto
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($productos as $producto)
                    <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                        <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->title }}" class="w-full h-48 object-cover rounded mb-4">
                        <h2 class="text-lg font-semibold mb-2 truncate">{{ $producto->title }}</h2>
                        <p class="text-gray-600 text-sm mb-2 flex-grow">{{ Str::limit($producto->description, 80) }}</p>
                        <p class="text-gray-500 text-xs mb-2">Estado: <span class="capitalize">{{ str_replace('_', ' ', $producto->estado) }}</span></p>
                        <p class="text-gray-500 text-xs mb-4">Transacción: <span class="capitalize">{{ $producto->transaction_type }}</span></p>
                        <a href="#" class="mt-auto inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-center">Ver detalle</a>
                    </div>
                @endforeach
            </div>
        @endif

    </main>

    <footer class="bg-white shadow p-4">
        <div class="max-w-xl mx-auto flex justify-center space-x-4">
            <a href="{{ route('productos.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300">Añadir Producto</a>
            <a href="{{ route('productos.personales') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300">Ver mis productos</a>
        </div>
    </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 py-8 px-4">

<div class="max-w-6xl mx-auto">
    <div class="relative flex items-center justify-center mb-6">
        <h1 class="text-3xl font-bold text-white absolute left-1/2 transform -translate-x-1/2">
            Mis Productos
        </h1>
        <a href="{{ route('productos.stock') }}"
        class="ml-auto bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded shadow">
            Volver al Catálogo
        </a>
    </div>


    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    @if ($productos->isEmpty())
        <!-- Fondo completo con mensaje centrado -->
        <div class="flex items-center justify-center h-[60vh]">
            <p class="text-white text-xl text-center">No has publicado ningún producto aún.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($productos as $producto)
                <div class="bg-white rounded shadow p-4">
                    <img src="{{ asset('storage/' . $producto->image) }}" alt="Imagen del producto"
                         class="w-full h-48 object-cover rounded mb-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $producto->title }}</h2>
                    <p class="text-gray-600 mb-1"><strong>Descripción:</strong> {{ $producto->description }}</p>
                    <p class="text-gray-600 mb-1"><strong>Estado:</strong> <span class="capitalize">{{ $producto->estado }}</span></p>
                    <p class="text-gray-600 mb-1"><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                    <p class="text-gray-600 mb-1"><strong>Tipo de Transacción:</strong> <span class="capitalize">{{ $producto->transaction_type }}</span></p>
                    <p class="text-gray-600 mb-4"><strong>Ubicación:</strong> {{ $producto->location }}</p>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('productos.edit', $producto->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            Editar
                        </a>

                        <!-- Botón para abrir modal -->
                        <button onclick="openModal({{ $producto->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">
                            Eliminar
                        </button>
                    </div>
                </div>

                <!-- Modal de confirmación -->
                <div id="modal-{{ $producto->id }}" class="fixed inset-0 hidden bg-black bg-opacity-50 z-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">¿Eliminar producto?</h2>
                        <p class="text-gray-600 mb-6">¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.</p>
                        <div class="flex justify-end gap-4">
                            <button onclick="closeModal({{ $producto->id }})"
                                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                                Cancelar
                            </button>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>

</body>
</html>

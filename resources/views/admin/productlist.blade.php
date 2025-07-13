<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de productos (Admin)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">

    <header class="p-4">
        <h1 class="text-3xl font-bold text-center text-white">Lista de productos</h1>
    </header>

    <main class="flex-grow overflow-y-auto container mx-auto px-4 py-6">

        @if(session('success'))
            <div id="flash-message" class="mb-6 max-w-xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const msg = document.getElementById('flash-message');
                    if(msg) msg.style.display = 'none';
                }, 1000); // desaparece después de 1 segundo
            </script>
        @endif


        @if($productos->isEmpty())
            <div class="flex flex-col items-center justify-center h-[60vh] text-white text-xl font-semibold">
                No hay productos disponibles.
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($productos as $producto)
                    <div class="bg-white bg-opacity-20 rounded-lg shadow p-4 flex flex-col transition hover:shadow-lg hover:-translate-y-1 duration-200">
                        {{-- Solo enlace para ver detalles (no para editar) --}}
                        <a href="{{ route('admin.productlist.show', $producto->id) }}" class="cursor-pointer">
                            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->title }}" class="w-full h-48 object-cover rounded mb-4 border-0">
                            <h2 class="text-lg font-semibold mb-2 truncate text-white">{{ $producto->title }}</h2>
                            <p class="text-white text-sm capitalize">Transacción: {{ $producto->transaction_type }}</p>
                        </a>

                        {{-- Botón para abrir modal eliminar --}}
                        <div class="mt-auto pt-4">
                            <button onclick="openModal({{ $producto->id }})" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Eliminar
                            </button>
                        </div>
                    </div>

                    <!-- Modal de confirmación -->
                    <div id="modal-{{ $producto->id }}" class="fixed inset-0 hidden bg-black bg-opacity-50 z-50 flex items-center justify-center">
                        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">¿Eliminar producto?</h2>
                            <p class="text-gray-600 mb-6">¿Estás seguro de que quieres eliminar el producto <strong>{{ $producto->title }}</strong>? Esta acción no se puede deshacer.</p>
                            <div class="flex justify-end gap-4">
                                <button onclick="closeModal({{ $producto->id }})" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                                    Cancelar
                                </button>
                                <form action="{{ route('admin.productlist.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </main>

    <footer class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 shadow p-4 sticky bottom-0 z-50">
        <div class="max-w-xl mx-auto flex justify-center space-x-4">
            <a href="{{ route('admin.panel') }}" class="bg-gray-700 bg-opacity-80 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Volver al panel
            </a>
        </div>
    </footer>

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

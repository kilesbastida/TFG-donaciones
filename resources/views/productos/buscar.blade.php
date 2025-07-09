<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buscar Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md relative">
        <div class="relative mb-6 pb-2">
            <h2 class="text-2xl font-bold text-gray-800 text-center">Buscar Productos</h2>

            <button id="btn-reiniciar"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 w-10 h-10 flex items-center justify-center rounded-full bg-gray-300 hover:bg-gray-400 transition"
                type="button" title="Reiniciar filtros" aria-label="Reiniciar filtros">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h5M20 20v-5h-5" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 9a8 8 0 0113.657-3.657M20 15a8 8 0 01-13.657 3.657" />
                </svg>
            </button>
        </div>

        <form action="{{ route('productos.stock') }}" method="GET" id="form-busqueda">

            {{-- Título --}}
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">Título</label>
                <input type="text" name="title" id="title"
                    class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    placeholder="Escribe el título del producto" value="{{ $filtros['title'] ?? '' }}">
            </div>

            {{-- Estado --}}
            <div class="mb-4">
                <label for="estado" class="block text-gray-700 font-semibold">Estado</label>
                <select name="estado" id="estado"
                    class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="nuevo" {{ ($filtros['estado'] ?? '') === 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                    <option value="buen_estado" {{ ($filtros['estado'] ?? '') === 'buen_estado' ? 'selected' : '' }}>Buen estado</option>
                    <option value="lo_ha_dado_todo" {{ ($filtros['estado'] ?? '') === 'lo_ha_dado_todo' ? 'selected' : '' }}>Lo ha dado todo</option>
                </select>
            </div>

            {{-- Categoría --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Categorías</label>
                <div id="categoria-container">
                    @php
                        $categoriasSeleccionadas = (array) ($filtros['categoria'] ?? ['']);
                    @endphp

                    @foreach($categoriasSeleccionadas as $i => $catSeleccionada)
                        <div class="flex items-center gap-2 mb-2 categoria-item">
                            <select name="categoria[]" class="flex-1 border border-gray-300 p-2 rounded">
                                <option value="all" {{ $catSeleccionada === 'all' ? 'selected' : '' }}>Todas</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $catSeleccionada == $categoria->id ? 'selected' : '' }}>
                                        {{ ucfirst($categoria->nombre) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="remove-categoria text-red-600 text-xl font-bold">&minus;</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-categoria" class="text-blue-600 font-semibold hover:underline mt-1">+ Añadir otra categoría</button>
            </div>


            {{-- Tipo de transacción --}}
            <div class="mb-4">
                <label for="transaction_type" class="block text-gray-700 font-semibold">Tipo de transacción</label>
                <select name="transaction_type" id="transaction_type"
                    class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas</option>
                    <option value="donacion" {{ ($filtros['transaction_type'] ?? '') === 'donacion' ? 'selected' : '' }}>Donación</option>
                    <option value="intercambio" {{ ($filtros['transaction_type'] ?? '') === 'intercambio' ? 'selected' : '' }}>Intercambio</option>
                    <option value="ambas" {{ ($filtros['transaction_type'] ?? '') === 'ambas' ? 'selected' : '' }}>Ambas</option>
                </select>
            </div>

            {{-- Ciudad --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Ciudades</label>
                <div id="ciudad-container">
                    @php
                        $ciudadesSeleccionadas = (array) ($filtros['location'] ?? ['']);
                    @endphp

                    @foreach($ciudadesSeleccionadas as $i => $ciudadSeleccionada)
                        <div class="flex items-center gap-2 mb-2 ciudad-item">
                            <select name="location[]" class="flex-1 border border-gray-300 p-2 rounded">
                                <option value="all" {{ $ciudadSeleccionada === 'all' ? 'selected' : '' }}>Todas</option>
                                @foreach($ciudades as $ciudad)
                                    <option value="{{ $ciudad }}" {{ $ciudadSeleccionada === $ciudad ? 'selected' : '' }}>
                                        {{ $ciudad }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="remove-ciudad text-red-600 text-xl font-bold">&minus;</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-ciudad" class="text-blue-600 font-semibold hover:underline mt-1">+ Añadir otra ciudad</button>
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-200">
                    Filtrar
                </button>
            </div>
        </form>

        <a href="{{ route('productos.stock') }}"
            class="block w-full bg-red-600 hover:bg-red-700 text-white text-center font-bold py-2 px-4 rounded-md transition duration-200">
            Cancelar
        </a>
    </div>

    <script>
        // Botón reiniciar
        document.getElementById('btn-reiniciar').addEventListener('click', () => {
            window.location.href = "{{ route('productos.buscar') }}";
        });

        // Agregar y quitar categorías
        document.getElementById('add-categoria').addEventListener('click', () => {
            const container = document.getElementById('categoria-container');
            const item = container.querySelector('.categoria-item');
            const clone = item.cloneNode(true);

            clone.querySelector('select').value = 'all';

            if (!clone.querySelector('.remove-categoria')) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'remove-categoria text-red-600 text-xl font-bold';
                btn.innerHTML = '&minus;';
                clone.appendChild(btn);
            }

            container.appendChild(clone);
        });


        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-categoria')) {
                const items = document.querySelectorAll('.categoria-item');
                if (items.length > 1) {
                    e.target.closest('.categoria-item').remove();
                } else {
                    // Opcional: alerta o feedback visual
                    alert("Debe quedar al menos una categoría.");
                }
            }
        });

        document.getElementById('add-ciudad').addEventListener('click', () => {
            const container = document.getElementById('ciudad-container');
            const item = container.querySelector('.ciudad-item');
            const clone = item.cloneNode(true);

            clone.querySelector('select').value = 'all';

            if (!clone.querySelector('.remove-ciudad')) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'remove-ciudad text-red-600 text-xl font-bold';
                btn.innerHTML = '&minus;';
                clone.appendChild(btn);
            }

            container.appendChild(clone);
        });

        // Eliminar ciudad
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-ciudad')) {
                const items = document.querySelectorAll('.ciudad-item');
                if (items.length > 1) {
                    e.target.closest('.ciudad-item').remove();
                } else {
                    alert("Debe quedar al menos una ciudad.");
                }
            }
        });
        
    </script>
</body>
</html>
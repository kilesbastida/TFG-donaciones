<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Buscar Productos</h2>

        <form action="{{ route('productos.stock') }}" method="GET">
            @csrf

            <!-- Filtro por título -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">Título</label>
                <input type="text" name="title" id="title"
                       class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Escribe el título del producto">
            </div>

            <!-- Filtro por estado -->
            <div class="mb-4">
                <label for="estado" class="block text-gray-700 font-semibold">Estado</label>
                <select name="estado" id="estado"
                        class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="buen_estado">Buen estado</option>
                    <option value="lo_ha_dado_todo">Lo ha dado todo</option>
                </select>
            </div>

            <!-- Filtro por tipo de transacción -->
            <div class="mb-4">
                <label for="transaction_type" class="block text-gray-700 font-semibold">Tipo de transacción</label>
                <select name="transaction_type" id="transaction_type"
                        class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas</option>
                    <option value="donacion">Donación</option>
                    <option value="intercambio">Intercambio</option>
                    <option value="ambas">Ambas</option>
                </select>
            </div>

            <!-- Filtro por ciudad -->
            <div class="mb-6">
                <label for="location" class="block text-gray-700 font-semibold">Ciudad</label>
                <input type="text" name="location" id="location"
                       class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Escribe la ciudad">
            </div>

            <!-- Botón de búsqueda -->
            <div class="mb-4">
                <button type="submit"
                        class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-200">
                    Filtrar
                </button>
            </div>
        </form>

        <!-- Botón de volver al stock -->
        <a href="{{ route('productos.stock') }}"
           class="block w-full bg-red-600 hover:bg-red-700 text-white text-center font-bold py-2 px-4 rounded-md transition duration-200">
            Cancelar
        </a>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Denuncias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-red-500 text-white font-['Roboto'] min-h-screen flex flex-col">

<header class="flex-shrink-0 py-10">
    <h2 class="text-4xl font-bold text-center text-black drop-shadow-lg">Gestión de Denuncias</h2>
</header>

<main class="flex-grow flex flex-col max-w-4xl mx-auto w-full px-10 space-y-6">

    <a href="{{ route('admin.denuncias.activas') }}" 
       class="flex items-center justify-center h-36 rounded-lg shadow-lg bg-red-600 hover:bg-red-700 transition duration-300 text-2xl font-semibold drop-shadow-lg">
        Denuncias Activas
    </a>

    <a href="{{ route('admin.denuncias.historial') }}" 
       class="flex items-center justify-center h-36 rounded-lg shadow-lg bg-green-600 hover:bg-green-700 transition duration-300 text-2xl font-semibold drop-shadow-lg">
        Historial de Denuncias
    </a>

</main>

<!-- Footer con botón grande -->
<footer class="py-6 mt-10">>
    <div class="text-center">
        <a href="{{ route('admin.panel') }}"
           class="inline-block bg-gray-800 hover:bg-gray-900 text-white text-lg font-bold py-3 px-10 rounded-lg transition duration-300 shadow-lg">
            Volver
        </a>
    </div>
</footer>

</body>
</html>

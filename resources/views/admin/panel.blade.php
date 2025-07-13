<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-red-500 text-white font-['Roboto'] min-h-screen flex flex-col">

    <header class="relative py-10 px-10">
        <h2 class="text-4xl font-bold text-center text-black drop-shadow-lg">Panel de administración</h2>
        <a href="{{ route('home') }}"
        class="absolute top-10 right-10 bg-gray-200 text-gray-800 hover:bg-gray-300 font-bold py-2 px-6 rounded-lg text-sm transition duration-300 shadow-md">
            Salir del modo admin
        </a>
    </header>



    <main class="flex-grow flex flex-col max-w-4xl mx-auto w-full px-10 space-y-6">

        <a href="{{ route('admin.userlist') }}" 
           class="flex items-center justify-center h-36 rounded-lg shadow-lg bg-blue-600 hover:bg-blue-700 transition duration-300 text-2xl font-semibold drop-shadow-lg">
            Gestión de usuarios
        </a>

        <a href="{{ route('admin.productlist') }}" 
           class="flex items-center justify-center h-36 rounded-lg shadow-lg bg-green-600 hover:bg-green-700 transition duration-300 text-2xl font-semibold drop-shadow-lg">
            Gestión de productos
        </a>

        <a href="{{ route('admin.denuncias') }}" 
            class="flex items-center justify-center h-36 rounded-lg shadow-lg bg-red-600 hover:bg-red-700 transition duration-300 text-2xl font-semibold drop-shadow-lg">
            Gestión de denuncias
        </a>


    </main>

</body>
</html>

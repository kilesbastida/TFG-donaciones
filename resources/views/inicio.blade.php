<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script> <!-- Por si usas Tailwind directamente -->
</head>

<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 text-white font-['Roboto']">

    <!-- 🔝 Header con botones arriba a la derecha -->
    <header class="w-full p-4 flex justify-end items-center space-x-4 absolute top-0 right-0 z-10">
        @guest
            <a href="{{ route('login') }}"
                class="border border-white hover:bg-white hover:text-blue-600 font-semibold py-2 px-4 rounded-lg transition duration-300">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}"
                class="border border-white hover:bg-white hover:text-green-600 font-semibold py-2 px-4 rounded-lg transition duration-300">
                Registrarse
            </a>
        @else
            <span class="mr-4">Hola, <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Cerrar sesión
                </button>
            </form>
            <!--border border-white hover:bg-white hover:text-red-600 font-semibold py-2 px-4 rounded-lg transition duration-300-->
        @endguest
    </header>

    <!-- 🎯 Contenido centrado -->
    <main class="flex flex-col justify-center items-center h-screen">
        <!-- Título y descripción -->
        <div class="text-center px-4 mb-8">
            <h1 class="text-5xl font-extrabold mb-4 drop-shadow-lg">
                LocalGive
            </h1>
            <p class="text-xl font-medium max-w-xl mx-auto">
                Sitio web centrado en la donación e intercambio de productos
            </p>
        </div>
        
        <!-- Imagen debajo del título (no ocupa toda la pantalla) -->
        <div class="w-full max-w-3xl h-auto">
            <img src="{{ asset('img/intercambios.jpeg') }}" alt="Imagen de fondo" class="w-full h-auto object-cover rounded-md shadow-lg">
        </div>
    </main>

</body>

</html>

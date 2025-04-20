<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Vinculamos el archivo CSS para aplicar los estilos -->
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <!-- Usamos Google Fonts para mejorar la tipografía -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 text-white">

    <!-- Contenedor principal, centrado en la pantalla -->
    <div class="flex flex-col justify-center items-center h-screen">
        <div class="text-center">
            <!-- Título principal -->
            <h1 class="text-5xl font-extrabold mb-4 text-shadow-lg">
                LocalGive
            </h1>

            <!-- Descripción corta -->
            <p class="text-xl mb-8 font-medium">
                Sitio web centrado en la donación e intercambio de productos
            </p>

            <!-- Condicional para mostrar los enlaces si el usuario no está autenticado -->
            @guest
                <div class="space-x-4">
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                        Registrarse
                    </a>
                </div>
            @else
                <!-- Si el usuario está autenticado, mostramos su nombre y un botón de cerrar sesión -->
                <p class="text-lg mb-4">
                    Hola, <span class="font-bold">{{ Auth::user()->name }}</span>
                </p>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                        Cerrar Sesión
                    </button>
                </form>
            @endguest
        </div>
    </div>

</body>

</html>

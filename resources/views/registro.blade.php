<!-- resources/views/registro.blade.php -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="border border-white hover:bg-white hover:text-red-600 font-semibold py-2 px-4 rounded-lg transition duration-300">
                    Cerrar Sesión
                </button>
            </form>
        @endguest
    </header>

    <!-- 🎯 Formulario de Registro -->
    <main class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">Registrarse</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                    <input id="name" name="name" type="text" required
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Correo electrónico -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input id="email" name="email" type="email" required
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" name="password" type="password" required
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Botón de envío -->
                <button type="submit"
                    class="w-full py-2 px-4 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-300">
                    Registrarse
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Inicia sesión</a>
                </p>
            </div>
        </div>
    </main>

</body>

</html>

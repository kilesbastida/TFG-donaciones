<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Incluir Google Fonts (opcional) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Agregar TailwindCSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 h-screen flex items-center justify-center">

    <!-- Formulario de inicio de sesión -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar sesión</h2>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de inicio de sesión -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Campo de usuario -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Nombre de usuario</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" ... 
                       class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Escribe tu nombre de usuario" required>
            </div>

            <!-- Campo de contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold">Contraseña</label>
                <input type="password" name="password" id="password" 
                       class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Escribe tu contraseña" required>
            </div>

            <!-- Botón de inicio de sesión -->
            <div class="flex items-center justify-between">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-200">
                    Iniciar sesión
                </button>
            </div>

        <!-- Enlace para registrarse -->
        <div class="mt-6 text-center">
            <p class="text-gray-700">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Regístrate</a></p>
        </div>
    </div>
    
</body>

</html>

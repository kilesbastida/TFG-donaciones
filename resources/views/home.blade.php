<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white p-8 rounded-lg shadow-lg text-center w-full max-w-2xl">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">¡Bienvenido/a, {{ Auth::user()->name }}!</h1>

        <p class="text-lg mb-4 text-gray-600">Has iniciado sesión correctamente.</p>

        <div class="space-y-4">
            <a href="{{ route('profile.perfil') }}" class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Ir a mi perfil
            </a>

            <a href="{{ route('productos.stock') }}" class="block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Ver productos
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>

</body>
</html>

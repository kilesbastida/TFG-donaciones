<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white p-8 rounded-lg shadow-lg text-center w-full max-w-2xl">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">¡Bienvenido/a, {{ Auth::user()->name }}!</h1>

        <p class="text-lg mb-4 text-gray-600">Has iniciado sesión correctamente.</p>

        <div class="space-y-4">

            @if(Auth::user()->admin)
                <a href="{{ route('admin.panel') }}" class="block bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Panel de Administración
                </a>
            @endif
            <a href="{{ route('profile.perfil') }}" class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Ir a mi perfil
            </a>

            <a href="{{ route('productos.stock') }}" class="block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Ver productos
            </a>

            <a href="{{ route('solicitudes.index') }}" class="block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Ver solicitudes
            </a>

            <a href="{{ route('chat.index') }}" class="block bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Ir a mis chats
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

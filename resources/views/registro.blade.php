<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-6xl h-full flex justify-center items-center">
        <div class="w-full max-w-4xl">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Crear cuenta</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Usuario y Correo -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Usuario</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Correo electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contraseña y Confirmar Contraseña -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="w-full border border-gray-300 rounded-lg px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full border border-gray-300 rounded-lg px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- Teléfono de contacto y Ubicación -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Teléfono de contacto</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-gray-700 font-semibold mb-2">Ubicación (Ciudad)</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tipo de transacción preferido -->
                <div class="mb-4">
                    <label for="transaction_type" class="block text-gray-700 font-semibold mb-2">Tipo de transacción preferido</label>
                    <select name="transaction_type" id="transaction_type" class="w-full border border-gray-300 rounded-lg px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="donacion">Donación</option>
                        <option value="intercambio">Intercambio</option>
                    </select>
                    @error('transaction_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Registrarme
                </button>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline text-sm">
                        ¿Ya tienes una cuenta? Inicia sesión
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
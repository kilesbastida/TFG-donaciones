<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Mi Perfil</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Imagen de perfil -->
            <div class="flex justify-center mb-6">
                <div class="text-center">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover mx-auto">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-300 mx-auto flex items-center justify-center text-gray-600">
                            Sin imagen
                        </div>
                    @endif
                    <input type="file" name="avatar" class="mt-2 block w-full text-sm text-gray-600">
                </div>
            </div>

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block font-semibold text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Correo -->
            <div class="mb-4">
                <label for="email" class="block font-semibold text-gray-700">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña nueva -->
            <div class="mb-4">
                <label for="password" class="block font-semibold text-gray-700">Nueva contraseña</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                       placeholder="Dejar en blanco si no deseas cambiarla">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div class="mb-6">
                <label for="password_confirmation" class="block font-semibold text-gray-700">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Botón -->
            <div class="text-center">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>

</body>
</html>

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
                        <img id="avatar-preview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover mx-auto">
                    @else
                        <div id="avatar-preview" class="w-32 h-32 rounded-full bg-gray-300 mx-auto flex items-center justify-center text-gray-600">
                            Sin imagen
                        </div>
                    @endif

                    <!-- Estilo mejorado para el botón de selección -->
                    <label for="avatar" class="mt-2 block w-full cursor-pointer text-sm text-white bg-blue-500 hover:bg-blue-600 font-semibold py-2 px-4 rounded-lg text-center transition duration-300">
                        Seleccionar imagen
                    </label>
                    <input type="file" name="avatar" id="avatar" class="hidden" onchange="previewImage(event)">
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

            <!-- Botones de acción (Guardar cambios y Volver) -->
            <div class="flex justify-center space-x-4">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    Guardar cambios
                </button>
                
                <!-- Botón de volver -->
                <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    Volver a inicio
                </a>
            </div>

        </form>
    </div>

    <script>
        // Función para previsualizar la imagen seleccionada
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            // Función que se ejecuta cuando el archivo es cargado
            reader.onload = function() {
                const preview = document.getElementById('avatar-preview');
                preview.src = reader.result; // Establece la imagen seleccionada como vista previa
                preview.classList.remove('bg-gray-300'); // Elimina el fondo gris
            }

            // Lee la imagen seleccionada
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>

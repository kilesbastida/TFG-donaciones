<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Perfil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 h-screen flex items-center justify-center p-4">

  @if(session('success'))
    <div
      id="success-notification"
      class="fixed top-4 right-4 bg-green-100 text-green-800 p-3 rounded shadow-md text-sm font-medium z-50 animate-fade-in"
      role="alert"
    >
      {{ session('success') }}
    </div>
  @endif

  <div class="max-w-4xl w-full bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Mi Perfil</h2>

    <!-- Formulario -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
      @csrf

      <!-- Imagen de perfil -->
      <div class="flex justify-center mb-6">
        <div class="text-center">
          @if(Auth::user()->avatar)
            <img id="avatar-preview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover mx-auto border border-gray-300 cursor-pointer">
          @else
            <div id="avatar-preview" class="w-24 h-24 rounded-full bg-gray-300 mx-auto flex items-center justify-center text-gray-600 text-sm border border-gray-300 cursor-default">
              Sin imagen
            </div>
          @endif

          <label for="avatar" class="mt-2 block cursor-pointer text-sm text-white bg-blue-500 hover:bg-blue-600 font-semibold py-2 px-4 rounded-lg text-center transition duration-300">
            Seleccionar imagen
          </label>
          <input type="file" name="avatar" id="avatar" class="hidden" onchange="previewImage(event)">
        </div>
      </div>

      <!-- Grid de campos -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Nombre -->
        <div>
          <label for="name" class="block font-semibold text-gray-700 mb-1">Nombre</label>
          <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
          @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Correo -->
        <div>
          <label for="email" class="block font-semibold text-gray-700 mb-1">Correo electrónico</label>
          <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
          @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Contraseña -->
        <div>
          <label for="password" class="block font-semibold text-gray-700 mb-1">Nueva contraseña</label>
          <input type="password" name="password" id="password"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                 placeholder="Opcional">
          @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div>
          <label for="password_confirmation" class="block font-semibold text-gray-700 mb-1">Confirmar contraseña</label>
          <input type="password" name="password_confirmation" id="password_confirmation"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- Teléfono -->
        <div>
          <label for="phone" class="block font-semibold text-gray-700 mb-1">Teléfono</label>
          <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
          @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Ubicación -->
        <div class="mb-4">
          <label for="location" class="block text-gray-700 font-semibold mb-1">Ciudad</label>
          <select name="location" id="location" class="w-full border border-gray-300 rounded px-3 py-2" required>
            <option value="">Seleccionar ciudad</option>
            @foreach($ciudades as $ciudad)
              <option value="{{ $ciudad }}" @if(Auth::user()->location == $ciudad) selected @endif>{{ $ciudad }}</option>
            @endforeach
          </select>
        </div>

      </div>

      <!-- Tipo de transacción -->
      <div class="mt-4">
        <label for="transaction_type" class="block font-semibold text-gray-700 mb-1">Tipo de transacción</label>
        <select name="transaction_type" id="transaction_type"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
          <option value="donacion" {{ old('transaction_type', Auth::user()->transaction_type) == 'donacion' ? 'selected' : '' }}>Donación</option>
          <option value="intercambio" {{ old('transaction_type', Auth::user()->transaction_type) == 'intercambio' ? 'selected' : '' }}>Intercambio</option>
          <option value="ambas" {{ old('transaction_type', Auth::user()->transaction_type) == 'ambas' ? 'selected' : '' }}>Ambas</option>
        </select>
        @error('transaction_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Botones -->
      <div class="flex justify-center space-x-4 mt-6">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-lg transition duration-300 text-sm">
          Guardar cambios
        </button>
        <a href="{{ route('home') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2.5 px-8 rounded-lg transition duration-300 text-sm">
          Volver a inicio
        </a>
      </div>
    </form>
  </div>

  <!-- Modal para mostrar imagen en grande -->
  <div id="image-modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modal-title" aria-describedby="modal-desc">
    <div class="relative max-w-[90vw] max-h-[90vh]">
      <button id="modal-close" class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-gray-300" aria-label="Cerrar">&times;</button>
      <img id="modal-image" src="" alt="Imagen ampliada" class="max-w-full max-h-full rounded shadow-lg object-contain" />
    </div>
  </div>

  <style>
    @keyframes fade-in {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fade-in {
      animation: fade-in 0.3s ease forwards;
    }
  </style>

  <script>
    // Desaparece la notificación tras 1,5 segundos
    window.addEventListener('DOMContentLoaded', () => {
      const notification = document.getElementById('success-notification');
      if (notification) {
        setTimeout(() => {
          notification.style.transition = 'opacity 0.5s ease';
          notification.style.opacity = '0';
          setTimeout(() => {
            notification.remove();
          }, 500);
        }, 1500);
      }
    });

    function previewImage(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = function () {
        const preview = document.getElementById('avatar-preview');
        if (preview.tagName === 'IMG') {
          preview.src = reader.result;
        } else {
          const img = document.createElement('img');
          img.src = reader.result;
          img.classList.add('w-24', 'h-24', 'rounded-full', 'object-cover', 'mx-auto', 'border', 'border-gray-300', 'cursor-pointer');
          img.id = 'avatar-preview';
          preview.replaceWith(img);
          setupModal(); // Reinicializar el modal para el nuevo elemento img
        }
      };
      if (file) {
        reader.readAsDataURL(file);
      }
    }

    function setupModal() {
      const avatarPreview = document.getElementById('avatar-preview');
      const imageModal = document.getElementById('image-modal');
      const modalImage = document.getElementById('modal-image');
      const modalClose = document.getElementById('modal-close');

      if (!avatarPreview) return;

      avatarPreview.style.cursor = 'pointer';

      avatarPreview.onclick = () => {
        if (avatarPreview.tagName === 'IMG') {
          modalImage.src = avatarPreview.src;
          imageModal.classList.remove('hidden');
        }
      };

      modalClose.onclick = () => {
        imageModal.classList.add('hidden');
      };

      imageModal.onclick = (e) => {
        if (e.target === imageModal) {
          imageModal.classList.add('hidden');
        }
      };
    }

    document.addEventListener('DOMContentLoaded', setupModal);
  </script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Usuario</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white font-['Roboto'] min-h-screen flex items-center justify-center p-6">

  @if(session('success'))
    <div
      id="success-notification"
      class="fixed top-4 right-4 bg-green-100 text-green-800 p-3 rounded shadow-md text-sm font-medium z-50 animate-fade-in"
      role="alert"
    >
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg text-gray-800">
    <h2 class="text-3xl font-bold mb-6 text-center">Editar Usuario</h2>

    <form method="POST" action="{{ route('admin.userlist.update', $user->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-semibold mb-1">Nombre</label>
        <input
          type="text"
          name="name"
          id="name"
          value="{{ old('name', $user->name) }}"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
          required
        >
        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          value="{{ old('email', $user->email) }}"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
          required
        >
        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="mb-6">
        <label for="admin" class="block text-gray-700 font-semibold mb-1">Administrador</label>
        <select
          name="admin"
          id="admin"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
        >
          <option value="0" {{ old('admin', $user->admin) == 0 ? 'selected' : '' }}>No</option>
          <option value="1" {{ old('admin', $user->admin) == 1 ? 'selected' : '' }}>Sí</option>
        </select>
      </div>

      <div class="flex justify-between">
        <button
          type="submit"
          class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300"
        >
          Guardar Cambios
        </button>
        <a
          href="{{ route('admin.userlist') }}"
          class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300"
        >
          Cancelar
        </a>
      </div>
    </form>
  </div>

  <style>
    @keyframes fade-in {
      from {opacity: 0; transform: translateY(-10px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .animate-fade-in {
      animation: fade-in 0.3s ease forwards;
    }
  </style>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const notification = document.getElementById('success-notification');
      if (notification) {
        setTimeout(() => {
          notification.style.transition = 'opacity 0.5s ease';
          notification.style.opacity = '0';
          setTimeout(() => notification.remove(), 500);
        }, 1500);
      }
    });
  </script>

</body>
</html>

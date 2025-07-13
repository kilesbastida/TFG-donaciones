<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gestión de usuarios</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white font-['Roboto'] min-h-screen p-6">

  @if(session('success'))
    <div
      id="success-notification"
      class="fixed top-4 right-4 bg-green-100 text-green-800 p-3 rounded shadow-md text-sm font-medium z-50 animate-fade-in"
      role="alert"
    >
      {{ session('success') }}
    </div>
  @endif

  <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg p-6 text-gray-800">
    <h1 class="text-3xl font-bold mb-6 text-center">Gestión de usuarios</h1>

    <table class="min-w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Admin</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr class="hover:bg-gray-50">
            <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $user->admin ? 'Sí' : 'No' }}</td>
            <td class="border border-gray-300 px-4 py-2 space-x-2">
              <a href="{{ route('admin.userlist.edit', $user->id) }}" class="text-blue-600 hover:underline">Editar</a>

              <!-- Botón para abrir modal -->
              <button onclick="openModal({{ $user->id }})" class="text-red-600 hover:underline">
                Eliminar
              </button>
            </td>
          </tr>

          <!-- Modal de confirmación -->
          <div id="modal-{{ $user->id }}" class="fixed inset-0 hidden bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
              <h2 class="text-xl font-bold text-gray-800 mb-4">¿Eliminar usuario?</h2>
              <p class="text-gray-600 mb-6">¿Estás seguro de que quieres eliminar al usuario <strong>{{ $user->name }}</strong>? Esta acción no se puede deshacer.</p>
              <div class="flex justify-end gap-4">
                <button onclick="closeModal({{ $user->id }})" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                  Cancelar
                </button>
                <form action="{{ route('admin.userlist.destroy', $user->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
                    Eliminar
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </tbody>
    </table>

  </div>

  <div class="max-w-6xl mx-auto mt-6 text-center">
    <a href="{{ route('admin.panel') }}" class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
      Volver al panel
    </a>
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

    function openModal(id) {
      document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
      document.getElementById('modal-' + id).classList.add('hidden');
    }
  </script>

</body>
</html>

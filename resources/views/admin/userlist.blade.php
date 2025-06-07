<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gestión de Usuarios</title>
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
    <h1 class="text-3xl font-bold mb-6 text-center">Gestión de Usuarios</h1>

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

              <form method="POST" action="{{ route('admin.userlist.destroy', $user->id) }}" class="inline" onsubmit="return confirm('¿Eliminar este usuario?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>

  <div class="max-w-6xl mx-auto mt-6 text-center">
    <a href="{{ route('admin.panel') }}" class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
      Volver al Panel
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
  </script>

</body>
</html>

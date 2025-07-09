<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Producto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-6">

  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Agregar nuevo producto</h2>

    @if ($errors->any())
      <div class="mb-4">
        <ul class="text-red-500 text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Imagen -->
      <div class="mb-4 text-center">
        <div id="image-preview" class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center text-sm text-gray-600 border border-gray-300 overflow-hidden">
          <span>Sin imagen</span>
        </div>
        <label for="image" class="mt-2 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded cursor-pointer">
          Seleccionar imagen
        </label>
        <input type="file" name="image" id="image" class="hidden" onchange="previewImage(event)">
      </div>

      <!-- Título y Descripción -->
      <div class="mb-4">
        <label for="title" class="block text-gray-700 font-semibold mb-1">Título</label>
        <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded px-3 py-2" required>
      </div>

      <div class="mb-4">
        <label for="description" class="block text-gray-700 font-semibold mb-1">Descripción</label>
        <textarea name="description" id="description" class="w-full border border-gray-300 rounded px-3 py-2" rows="3" required></textarea>
      </div>

      <!-- Estado -->
      <div class="mb-4">
        <label for="estado" class="block text-gray-700 font-semibold mb-1">Estado</label>
        <select name="estado" id="estado" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="nuevo">Nuevo</option>
          <option value="buen_estado">Buen estado</option>
          <option value="lo_ha_dado_todo">Lo ha dado todo</option>
        </select>
      </div>

      <!-- Categoria -->
      <div class="mb-4">
        <label for="category_id" class="block text-gray-700 font-semibold mb-1">Categoría</label>
        <select name="categoria_id" id="categoria_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="">Seleccionar categoría</option>
          @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">
                {{ $categoria->nombre }}
            </option>
        @endforeach
        </select>
      </div>

      <!-- Tipo de transacción -->
      <div class="mb-4">
        <label for="transaction_type" class="block text-gray-700 font-semibold mb-1">Tipo de transacción</label>
        <select name="transaction_type" id="transaction_type" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="donacion">Donación</option>
          <option value="intercambio">Intercambio</option>
          <option value="ambas">Ambas</option>
        </select>
      </div>

      <!-- Ubicación -->
      <div class="mb-4">
        <label for="location" class="block text-gray-700 font-semibold mb-1">Ciudad</label>
        <select name="location" id="location" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="">Seleccionar ciudad</option>
          @foreach($ciudades as $ciudad)
            <option value="{{ $ciudad }}" {{ old('location', Auth::user()->location) == $ciudad ? 'selected' : '' }}>{{ $ciudad }}</option>
          @endforeach
        </select>
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
          Guardar producto
        </button>
        <a href="{{ route('productos.stock') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded">
          Cancelar
        </a>
      </div>
    </form>
  </div>

  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      const previewContainer = document.getElementById('image-preview');

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewContainer.innerHTML = '';
          const img = document.createElement('img');
          img.src = e.target.result;
          img.className = 'w-full h-full object-cover rounded-full';
          previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>
</html>

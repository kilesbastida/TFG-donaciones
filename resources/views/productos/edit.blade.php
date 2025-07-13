<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-6">

  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Editar Producto</h2>

    @if ($errors->any())
      <div class="mb-4">
        <ul class="text-red-500 text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Imagen actual con click para abrir modal -->
      <div class="mb-4 text-center">
        <div id="image-preview" 
          class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center border border-gray-300 overflow-hidden cursor-pointer"
          onclick="openModal()"
        >
          <img src="{{ asset('storage/' . $producto->image) }}" alt="Imagen actual" class="w-full h-full object-cover rounded-full" id="preview-img">
        </div>
        <label for="image" class="mt-2 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded cursor-pointer">
          Cambiar imagen
        </label>
        <input type="file" name="image" id="image" class="hidden" onchange="previewImage(event)">
        @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Resto del formulario igual -->
      <!-- Título -->
      <div class="mb-4">
        <label for="title" class="block text-gray-700 font-semibold mb-1">Título</label>
        <input type="text" name="title" id="title" value="{{ old('title', $producto->title) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
      </div>

      <!-- Descripción -->
      <div class="mb-4">
        <label for="description" class="block text-gray-700 font-semibold mb-1">Descripción</label>
        <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('description', $producto->description) }}</textarea>
        @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
      </div>

      <!-- Estado -->
      <div class="mb-4">
        <label for="estado" class="block text-gray-700 font-semibold mb-1">Estado</label>
        <select name="estado" id="estado" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="Nuevo" {{ old('estado', $producto->estado) == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
          <option value="Buen estado" {{ old('estado', $producto->estado) == 'Buen estado' ? 'selected' : '' }}>Buen estado</option>
          <option value="Lo ha dado todo" {{ old('estado', $producto->estado) == 'Lo ha dado todo' ? 'selected' : '' }}>Lo ha dado todo</option>
        </select>
        @error('estado') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
      </div>

      <!-- Categoria -->
      <div class="mb-4">
        <label for="categoria_id" class="block text-gray-700 font-semibold mb-1">Categoría</label>
        <select name="categoria_id" id="categoria_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="">Seleccionar categoría</option>
          @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
              {{ $categoria->nombre }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Tipo de transacción -->
      <div class="mb-4">
        <label for="transaction_type" class="block text-gray-700 font-semibold mb-1">Tipo de transacción</label>
        <select name="transaction_type" id="transaction_type" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="donacion" {{ old('transaction_type', $producto->transaction_type) == 'donacion' ? 'selected' : '' }}>Donación</option>
          <option value="intercambio" {{ old('transaction_type', $producto->transaction_type) == 'intercambio' ? 'selected' : '' }}>Intercambio</option>
          <option value="ambas" {{ old('transaction_type', $producto->transaction_type) == 'ambas' ? 'selected' : '' }}>Ambas</option>
        </select>
      </div>

      <!-- Ciudad -->
      <div class="mb-4">
        <label for="location" class="block text-gray-700 font-semibold mb-1">Ciudad</label>
        <select name="location" id="location" class="w-full border border-gray-300 rounded px-3 py-2" required>
          <option value="">Seleccionar ciudad</option>
          @foreach($ciudades as $ciudad)
            <option value="{{ $ciudad }}" {{ old('location', $producto->location) == $ciudad ? 'selected' : '' }}>
              {{ $ciudad }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-4 mt-6">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
          Guardar cambios
        </button>
        <a href="{{ route('productos.personales') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded">
          Cancelar
        </a>
      </div>
    </form>
  </div>

  <!-- Modal para imagen grande -->
  <div 
    id="image-modal" 
    class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden"
    onclick="closeModal()"
  >
    <div class="relative" onclick="event.stopPropagation()">
      <button 
        onclick="closeModal()" 
        class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-gray-300"
        aria-label="Cerrar"
      >&times;</button>

      <img 
        id="modal-image" 
        src="{{ asset('storage/' . $producto->image) }}" 
        alt="Imagen seleccionada" 
        class="max-w-[90vw] max-h-[90vh] object-contain rounded shadow-lg"
      >
    </div>
  </div>

  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      const previewContainer = document.getElementById('preview-img');
      const modalImage = document.getElementById('modal-image');

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewContainer.src = e.target.result;
          modalImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }

    function openModal() {
      document.getElementById('image-modal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('image-modal').classList.add('hidden');
    }
  </script>
</body>
</html>

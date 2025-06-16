<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Denunciar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<header class="bg-white shadow p-4">
    <h1 class="text-2xl font-bold text-center text-gray-800">Denunciar Usuario: {{ $usuario->name }}</h1>
</header>

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

        <form action="{{ route('denuncia.usuario.guardar', $usuario->id) }}" method="POST">
            @csrf

            <label class="block mb-2 font-semibold text-gray-700">Razón de la denuncia:</label>
            <select name="razon" required
                    class="w-full mb-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                <option value="" disabled selected>Selecciona una razón</option>
                <option value="contenido_inapropiado">Contenido inapropiado</option>
                <option value="fraude">Fraude</option>
                <option value="acoso">Acoso</option>
                <option value="otro">Otro</option>
            </select>

            <label class="block mb-2 font-semibold text-gray-700">Descripción:</label>
            <textarea name="descripcion" rows="5" required
                      class="w-full mb-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                      placeholder="Describe con detalle la razón de la denuncia"></textarea>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded transition">
                Enviar denuncia
            </button>
        </form>

        <a href="{{ route('home') }}" class="block mt-6 text-center text-purple-600 hover:underline">
            Volver
        </a>
    </div>
</main>

</body>
</html>

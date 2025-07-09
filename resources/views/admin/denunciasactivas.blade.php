<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Denuncias activas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-600 text-white font-['Roboto'] h-screen flex flex-col">

<header class="flex-shrink-0 py-10">
    <h2 class="text-4xl font-bold text-center drop-shadow-lg">Denuncias activas</h2>
    <nav class="flex justify-center space-x-6 mt-6">
        <a href="{{ route('admin.denuncias.activas') }}" class="font-semibold underline">Activas</a>
        <a href="{{ route('admin.denuncias.historial') }}" class="font-semibold hover:underline">Historial</a>
    </nav>
</header>

<main class="flex-grow max-w-4xl mx-auto w-full px-10 space-y-6 overflow-y-auto">
    @if ($denuncias->isEmpty())
        <p class="text-center text-lg">No hay denuncias activas en este momento.</p>
    @else
        <ul class="space-y-4">
            @foreach ($denuncias as $denuncia)
                <li class="bg-red-700 p-4 rounded shadow hover:bg-red-800 transition flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-semibold mb-1">Denuncia {{ $denuncia->id }}</h3>
                        <p>{{ $denuncia->descripcion }}</p>
                    </div>
                    <a href="{{ route('admin.denuncias.show', $denuncia->id) }}" 
                       class="inline-block px-5 py-2 bg-green-600 hover:bg-green-700 rounded font-semibold text-white transition">
                       Ver y resolver
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</main>

<footer class="flex-shrink-0 py-6 mt-10">
    <div class="text-center">
        <a href="{{ route('admin.panel') }}"
           class="inline-block bg-gray-800 hover:bg-gray-900 text-white text-lg font-bold py-3 px-10 rounded-lg transition duration-300 shadow-lg">
            Volver al panel
        </a>
    </div>
</footer>

</body>
</html>

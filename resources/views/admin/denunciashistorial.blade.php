<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Historial de Denuncias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-600 text-white font-['Roboto'] min-h-screen flex flex-col">

<header class="flex-shrink-0 py-10">
    <h2 class="text-4xl font-bold text-center drop-shadow-lg">Historial de Denuncias</h2>
    <nav class="flex justify-center space-x-6 mt-6">
        <a href="{{ route('admin.denuncias.activas') }}" class="font-semibold hover:underline">Activas</a>
        <a href="{{ route('admin.denuncias.historial') }}" class="font-semibold underline">Historial</a>
    </nav>
</header>

<main class="flex-grow max-w-4xl mx-auto w-full px-10 space-y-6">

    @if ($denuncias->isEmpty())
        <p class="text-center text-lg">No hay denuncias resueltas en el historial.</p>
    @else
        <ul class="space-y-4">
            @foreach ($denuncias as $denuncia)
                <li class="bg-green-700 p-4 rounded shadow hover:bg-green-800 transition">
                    <h3 class="text-2xl font-semibold">Denuncia #{{ $denuncia->id }}</h3>
                    <p>{{ $denuncia->descripcion }}</p>
                    <p><strong>Resolución:</strong> {{ $denuncia->resolucion }}</p>
                </li>
            @endforeach
        </ul>
    @endif

</main>

</body>
</html>

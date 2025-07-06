<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Solicitudes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen p-6 font-sans flex flex-col">

    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg flex-grow overflow-y-auto relative z-10">

        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Mis Solicitudes</h1>

        {{-- Mensajes de sesión --}}
        @if(session('success'))
            <div 
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 4000)"
                class="mb-6 max-w-xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center"
            >
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div 
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 4000)"
                class="mb-6 max-w-xl mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-center"
            >
                {{ session('error') }}
            </div>
        @endif

        {{-- Solicitudes recibidas --}}
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Solicitudes dirigidas a ti</h2>

        @if($recibidas->isEmpty())
            <p class="text-gray-600 mb-8">No tienes solicitudes recibidas.</p>
        @else
            <div class="space-y-4 mb-10">
                @foreach($recibidas as $solicitud)
                    <div class="p-4 bg-gray-50 border rounded-lg shadow-sm flex gap-4 items-center">
                        <img src="{{ asset('storage/' . $solicitud->producto->image) }}" alt="Imagen producto" class="w-24 h-24 object-cover rounded">
                        <div class="flex-1">
                            <p><strong>Producto:</strong> {{ $solicitud->producto->title }}</p>
                            <p><strong>Solicitante:</strong> {{ $solicitud->solicitante->name }}</p>
                            <p><strong>Ciudad:</strong> {{ $solicitud->solicitante->location }}</p>
                            <p><strong>Transacción:</strong> {{ ucfirst($solicitud->tipo) }}</p>
                            <p><strong>Estado:</strong> 
                                @if($solicitud->estado === 'pendiente')
                                    <span class="text-yellow-600 font-semibold">Pendiente</span>
                                @elseif($solicitud->estado === 'aceptada')
                                    <span class="text-green-600 font-semibold">Aceptada</span>
                                @elseif($solicitud->estado === 'entregado')
                                    <span class="text-blue-600 font-semibold">Entregado</span>
                                @else
                                    <span class="text-red-600 font-semibold">Rechazada</span>
                                @endif
                            </p>
                        </div>

                        <div class="flex flex-col gap-2">
                            @if($solicitud->estado === 'pendiente')
                                <form method="POST" action="{{ route('solicitudes.aceptar', $solicitud->id) }}">
                                    @csrf
                                    <input type="hidden" name="accion" value="aceptar">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Aceptar</button>
                                </form>

                                <form method="POST" action="{{ route('solicitudes.rechazar', $solicitud->id) }}">
                                    @csrf
                                    <input type="hidden" name="accion" value="rechazar">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Rechazar</button>
                                </form>
                            @elseif($solicitud->estado === 'aceptada')
                                <form method="POST" action="{{ route('solicitudes.entregar', $solicitud->id) }}">
                                    @csrf
                                    <input type="hidden" name="accion" value="entregar">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Marcar como entregado</button>
                                </form>
                            @elseif(in_array($solicitud->estado, ['entregado', 'rechazada']))
                                <form method="POST" action="{{ route('solicitudes.destroy', $solicitud->id) }}" onsubmit="return confirm('¿Seguro que quieres eliminar esta solicitud?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <hr class="my-10">

        {{-- Solicitudes enviadas --}}
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Solicitudes que enviaste</h2>

        @if($enviadas->isEmpty())
            <p class="text-gray-600">No has enviado ninguna solicitud todavía.</p>
        @else
            <div class="space-y-4">
                @foreach($enviadas as $solicitud)
                    <div class="p-4 bg-gray-50 border rounded-lg shadow-sm flex gap-4 items-center">
                        <img src="{{ asset('storage/' . $solicitud->producto->image) }}" alt="Imagen producto" class="w-24 h-24 object-cover rounded">
                        <div class="flex-1">
                            <p><strong>Producto:</strong> {{ $solicitud->producto->title }}</p>
                            <p><strong>Dueño del producto:</strong> {{ $solicitud->producto->usuario->name }}</p>
                            <p><strong>Ciudad:</strong> {{ $solicitud->producto->location }}</p>
                            <p><strong>Transacción:</strong> {{ ucfirst($solicitud->tipo) }}</p>
                            <p><strong>Estado:</strong> 
                                @if($solicitud->estado === 'pendiente')
                                    <span class="text-yellow-600 font-semibold">Pendiente</span>
                                @elseif($solicitud->estado === 'aceptada')
                                    <span class="text-green-600 font-semibold">Aceptada</span>
                                @elseif($solicitud->estado === 'entregado')
                                    <span class="text-blue-600 font-semibold">Entregado</span>
                                @else
                                    <span class="text-red-600 font-semibold">Rechazada</span>
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- Footer fijo con botón Volver --}}
    <footer class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 shadow p-4 sticky bottom-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-center">
            <a href="{{ route('home') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Volver
            </a>
        </div>
    </footer>

</body>
</html>

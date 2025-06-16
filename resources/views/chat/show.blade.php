<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chat con {{ $otherUser->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <header class="bg-white p-4 shadow flex justify-center items-center relative">
        <h1 class="text-xl font-semibold">
            Chat con {{ $otherUser->name }}
        </h1>
        <a href="{{ route('denuncia.usuario', $otherUser->id) }}"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded flex items-center space-x-2 transition duration-300 absolute right-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0zM12 9v4m0 4h.01" />
            </svg>
        </a>
    </header>

    <main class="flex-grow container mx-auto p-4 flex flex-col">
        <div class="flex-grow overflow-y-auto border rounded p-4 bg-white mb-4" style="max-height: 75vh;">
            @foreach($messages as $message)
                <div class="mb-2 flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs px-4 py-2 rounded-lg 
                        {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-800' }}">
                        <p>{{ $message->message }}</p>
                        <span class="block text-xs text-right mt-1">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('chat.store') }}" method="POST" class="flex space-x-2 mb-4" id="chatForm">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
            <textarea name="message" rows="2" required
                class="flex-grow rounded border border-gray-300 p-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Escribe tu mensaje..." id="messageInput"></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 rounded hover:bg-blue-700">Enviar</button>
        </form>
    </main>

    <!-- Footer fijo con ambos botones -->
    <footer class="bg-white shadow p-4 sticky bottom-0 z-50">
        <div class="max-w-xl mx-auto flex justify-center space-x-4">
            <a href="{{ route('productos.stock') }}" 
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                Volver al catálogo
            </a>
            <a href="{{ route('home') }}" 
               class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Volver
            </a>
        </div>
    </footer>

    <script>
        const textarea = document.getElementById('messageInput');
        textarea.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault(); // evita salto de línea
                document.getElementById('chatForm').submit();
            }
        });
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chat con {{ $otherUser->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <header class="bg-white p-4 shadow">
        <h1 class="text-xl font-semibold text-center">Chat con {{ $otherUser->name }}</h1>
    </header>

    <main class="flex-grow container mx-auto p-4 flex flex-col">
        <div class="flex-grow overflow-y-auto border rounded p-4 bg-white mb-4" style="max-height: 60vh;">
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

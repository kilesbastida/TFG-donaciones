<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mis Chats</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 min-h-screen flex flex-col">

<header class="p-4 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 text-white">
    <h1 class="text-3xl font-bold text-center">Mis Chats</h1>
</header>

<main class="flex-grow container mx-auto p-4">
    @if($users->isEmpty())
        <p class="text-center text-white mt-10">No tienes chats iniciados.</p>
    @else
        <ul class="max-w-md mx-auto space-y-4">
            @foreach($users as $user)
                <li>
                    <a href="{{ route('chat.show', $user->id) }}" 
                       class="block bg-white p-4 rounded shadow hover:bg-blue-50 transition flex items-center space-x-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Foto de {{ $user->name }}" 
                                 class="w-10 h-10 rounded-full object-cover" />
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="text-lg font-medium text-gray-900">{{ $user->name }}</div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</main>

<footer class="p-4 sticky bottom-0 z-50 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 text-white shadow">
    <div class="max-w-xl mx-auto flex justify-center space-x-4">
        <a href="{{ route('home') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
            Volver
        </a>
    </div>
</footer>

</body>
</html>

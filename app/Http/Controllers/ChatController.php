<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    public function iniciar(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $user1 = auth()->id();
        $user2 = $request->receiver_id;

        // Evitar iniciar chat con uno mismo
        if ($user1 == $user2) {
            return redirect()->back()->with('error', 'No puedes chatear contigo mismo.');
        }

        // Buscar chat existente entre estos dos usuarios
        $chatExists = Chat::where(function ($q) use ($user1, $user2) {
            $q->where('sender_id', $user1)->where('receiver_id', $user2);
        })->orWhere(function ($q) use ($user1, $user2) {
            $q->where('sender_id', $user2)->where('receiver_id', $user1);
        })->exists();

        // Simplemente redirigimos a la conversación si existe, sino no hace falta crear nada más, porque los mensajes se guardan en Chat
        return redirect()->route('chat.show', $user2);
    }

    // Mostrar conversación entre usuario autenticado y otro usuario
    public function show($userId)
    {
        $authUserId = Auth::id();

        // Obtener mensajes entre los dos usuarios ordenados por fecha ascendente
        $messages = Chat::where(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $authUserId)->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $authUserId);
        })->orderBy('created_at', 'asc')->get();

        // Obtener datos del otro usuario (para mostrar su nombre en la vista)
        $otherUser = User::findOrFail($userId);

        return view('chat.show', compact('messages', 'otherUser'));
    }

    // Guardar nuevo mensaje
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->route('chat.show', ['userId' => $request->receiver_id]);
    }
}

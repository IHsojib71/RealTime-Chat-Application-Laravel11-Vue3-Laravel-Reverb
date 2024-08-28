<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($friend)
    {
        return inertia('Chat/Index', ['friend' => User::find($friend)]);
    }

    public function fetchMessages($friend)
    {
        $messages = Chat::with('sender', 'receiver')
        ->where(function ($q) use($friend){
            $q->where('sender_id', auth()->id())
                ->where('receiver_id', $friend);
        })
        ->orWhere(function ($q) use($friend) {
            $q->where('sender_id', $friend)
                ->where('receiver_id', auth()->id());
        })
        ->orderBy('id', 'asc')
        ->get();

        return response()->json(['messages' => $messages]);

    }

    public function sendMessage(Request $request, $friend)
    {
        $message = Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $friend,
            'message' => $request->message,
        ]);
        return response()->json(['message' => $message]);
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($user)
    {
        return inertia('Chat/Index', ['user' => User::find($user)]);
    }

    public function fetchMessages($friend)
    {
        $messages = Chat::query()
        ->where(function ($q) use($friend){
            $q->where('sender_id', auth()->id())
                ->where('receiver_id', $friend);
        })
        ->orWhere(function ($q) use($friend) {
            $q->where('sender_id', $friend)
                ->where('receiver_id', auth()->id());
        })
        ->get();

    }


}

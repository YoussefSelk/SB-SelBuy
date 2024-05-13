<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\UserService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatForm($user_id, UserService $userService)
    {
        $receiver = $userService->getUser($user_id);
        return view('chat.index', compact('receiver'));
    }
    public function sendMessage($user_id, Request $request, UserService $userService)
    {
        $userService->sendMessage($user_id, $request->message);
        return response()->json('Message Sent');
    }
    public function getChatHistory($receiverId)
    {
        $authId = auth()->id();

        $messages = Message::where(function ($query) use ($authId, $receiverId) {
            $query->where('sender', $authId)
                ->where('receiver', $receiverId);
        })->orWhere(function ($query) use ($authId, $receiverId) {
            $query->where('sender', $receiverId)
                ->where('receiver', $authId);
        })->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as sent or received
        $messages = $messages->map(function ($message) use ($authId) {
            $message->sent_by_user = $message->sender == $authId;
            return $message;
        });

        return response()->json($messages);
    }
}

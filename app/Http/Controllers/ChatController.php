<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Services\UserService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatForm($user_id, UserService $userService)
    {
        $receiver = $userService->getUser($user_id);
        $conversation = $this->getOrCreateConversation($user_id);
        $conversations = $this->getConversations();
        return view('chat.index', compact('receiver', 'conversation', 'conversations'));
    }

    public function conversations()
    {
        return view('chat.conversations');
    }

    public function sendMessage($user_id, Request $request, UserService $userService)
    {
        // Check if user is trying to send message to themselves
        if ($user_id == auth()->id()) {
            return response()->json(['error' => 'Cannot send message to yourself'], 400);
        }

        $userService->sendMessage($user_id, $request->message);

        // Create or get conversation
        $conversation = $this->getOrCreateConversation($user_id);

        return response()->json(['message' => 'Message Sent', 'conversation_id' => $conversation->id]);
    }

    protected function getOrCreateConversation($user_id)
    {
        $authId = auth()->id();

        // Check if user is trying to create conversation with themselves
        if ($user_id == $authId) {
            return null; // Return null if trying to create conversation with oneself
        }

        // Check if conversation already exists
        $conversation = Conversation::where(function ($query) use ($authId, $user_id) {
            $query->where('user_1', $authId)
                ->where('user_2', $user_id);
        })->orWhere(function ($query) use ($authId, $user_id) {
            $query->where('user_1', $user_id)
                ->where('user_2', $authId);
        })->first();

        // If conversation does not exist, create it
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_1' => $authId,
                'user_2' => $user_id,
            ]);
        }

        return $conversation;
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

    public function getConversations()
    {
        $user_id = auth()->id();

        $conversations = Conversation::where('user_1', $user_id)
            ->orWhere('user_2', $user_id)
            ->with(['user1', 'user2'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json($conversations);
    }
}

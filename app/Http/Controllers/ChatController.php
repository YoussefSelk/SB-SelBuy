<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }
    public function latestMessages($toUserId)
    {
        $messages = Message::where('to_user_id', auth()->id())
            ->where('from_user_id', $toUserId)
            ->where('created_at', '>', now()->subSeconds(2))
            ->get();

        return response()->json(['messages' => $messages]);
    }
    public function getConversations()
    {
        $userId = auth()->id();

        // Fetch conversations of the current user
        $conversations = Message::where('to_user_id', $userId)
            ->orWhere('from_user_id', $userId)
            ->with('sender')
            ->with('receiver')
            ->select('to_user_id', 'from_user_id')
            ->distinct()
            ->get();

        $participants = collect([]);

        foreach ($conversations as $conversation) {
            if ($conversation->from_user_id == $userId) {
                $participants->push($conversation->to_user_id);
            } else {
                $participants->push($conversation->from_user_id);
            }
        }

        // Fetch user details for each conversation
        $users = User::whereIn('id', $participants)->get(['id', 'name']);

        return response()->json($users);
    }

    public function getConversation($senderId)
    {
        $userId = auth()->id();

        // Fetch messages between the current user and the specific sender
        $messages = Message::where(function ($query) use ($userId, $senderId) {
            $query->where('from_user_id', $userId)
                ->where('to_user_id', $senderId);
        })->orWhere(function ($query) use ($userId, $senderId) {
            $query->where('from_user_id', $senderId)
                ->where('to_user_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->from_user_id = auth()->id();
        $message->to_user_id = $request->to_user_id;
        $message->message = $request->message;
        $message->save();

        // Broadcast event
        broadcast(new MessageSent($message));

        return response()->json(['status' => 'Message sent!', 'message' => $message]);
    }

    public function getMessageHistory($toUserId)
    {
        $userId = auth()->id();

        // Fetch messages
        $messages = Message::where(function ($query) use ($toUserId, $userId) {
            $query->where('from_user_id', $userId)
                ->where('to_user_id', $toUserId);
        })->orWhere(function ($query) use ($toUserId, $userId) {
            $query->where('from_user_id', $toUserId)
                ->where('to_user_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::get('/conversations', [ChatController::class, 'getConversations'])->name('conversations');
Route::get('/chat/{toUserId}', [ChatController::class, 'getConversation'])->name('chat.conversation');
Route::get('/message/history/{toUserId}', [ChatController::class, 'getMessageHistory'])->name('message.history');
Route::post('/send', [ChatController::class, 'sendMessage'])->name('send');

// Route to directly initiate conversation with a user
Route::get('/chat/start/{toUserId}', [ChatController::class, 'startConversation'])->name('chat.start');
Route::get('/message/latest/{toUserId}', 'ChatController@latestMessages');

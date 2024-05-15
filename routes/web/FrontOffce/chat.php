<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/chat', [ChatController::class, 'conversations'])->middleware('auth')->name('chat.conversations');
Route::get('/chat/{user_id}', [ChatController::class, 'chatForm'])->middleware('auth')->name('chat');
Route::post('/chat/{user_id}', [ChatController::class, 'sendMessage'])->middleware('auth');
Route::get('/chat/{receiverId}/history', [ChatController::class, 'getChatHistory'])->middleware('auth');
Route::get('/conversations', [ChatController::class, 'getConversations'])->middleware('auth');

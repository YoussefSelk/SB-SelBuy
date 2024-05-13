<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;


Route::get('/chat/{user_id}', [ChatController::class, 'chatForm'])->middleware('auth');
Route::post('/chat/{user_id}', [ChatController::class, 'sendMessage'])->middleware('auth');
Route::get('/chat/{receiverId}/history', [ChatController::class, 'getChatHistory']);

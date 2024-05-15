<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:Admin'])->name('admin.')->group(function () {
    Route::get('/posts/create', [AdminDashboardController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [AdminDashboardController::class, 'store'])->name('posts.store');
});

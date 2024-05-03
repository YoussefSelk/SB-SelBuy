<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:Admin'])->name('admin.')->group(function () {
    Route::get('/admin/categories', [AdminDashboardController::class, 'categories'])->name('categories');
});

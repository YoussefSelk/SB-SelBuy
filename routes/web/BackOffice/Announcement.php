<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->name('admin.')->group(function () {
    Route::get('/admin/announcements', [AdminDashboardController::class, 'announcement'])->name('announcements');
});

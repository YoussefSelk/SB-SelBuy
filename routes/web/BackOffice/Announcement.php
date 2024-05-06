<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:Admin'])->name('admin.')->group(function () {
    Route::get('/admin/announcements', [AdminDashboardController::class, 'announcement'])->name('announcements');

    Route::post('/admin/announcement/add', [AdminDashboardController::class, 'add_annoucement'])->name('add.announcement');

    Route::delete('/admin/announcement/delete/{id}', [AdminDashboardController::class, 'delete_announcement'])->name('delete.announcement');

    Route::get('/admin/announcement/details/{id}', [AdminDashboardController::class, 'details_annoucement'])->name('details.announcement');

    Route::get('/admin/announcement/image/delete/{id}', [AdminDashboardController::class, 'deleteImage'])->name('delete.image.annoucement');

    Route::post('/admin/announcement/{id}/add-images', [AdminDashboardController::class, 'addImages'])->name('add.images.annoucement');
});

<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:Admin'])->name('admin.')->group(function () {
    Route::get('/admin/posts/create', [AdminDashboardController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts/store', [AdminDashboardController::class, 'store'])->name('posts.store');
    Route::get('/admin/post/edit/{id}', [AdminDashboardController::class, 'edit_post_view'])->name('posts.edit.view');
    Route::put('/admin/post/edit/submit/{id}', [AdminDashboardController::class, 'edit_post'])->name('posts.edit');
    Route::delete('/admin/post/delete/{id}', [AdminDashboardController::class, 'delete_post'])->name('posts.delete');
    Route::delete('/admin/post/delete_image/{id}', [AdminDashboardController::class, 'delete_image'])->name('posts.delete_image');
});

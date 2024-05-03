<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:Admin'])->name('admin.')->group(function () {

    ///////////////////////////////          User View          ///////////////////////////////

    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('users');

    ///////////////////////////////         Edit User         ///////////////////////////////


    Route::get('/admin/user/edit/{id}', [AdminDashboardController::class, 'edit_user_view'])->name('edit.user');
    Route::post('/admin/user/edit/{id}/submit', [AdminDashboardController::class, 'edit_user'])->name('edit.user.submit');

    ///////////////////////////////         Delete User         ///////////////////////////////
    Route::delete('/admin/user/delete/{id}', [AdminDashboardController::class, 'delete_user'])->name('delete.user');

    ///////////////////////////////         User Add         ///////////////////////////////

    Route::post('/admin/user/add', [AdminDashboardController::class, 'add_user'])->name('add.user');


    ///////////////////////////////         User View Details         ///////////////////////////////

    Route::get('/admin/user/details/{id}', [AdminDashboardController::class, 'user_details'])->name('details.user');
});

<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:Admin'])->name('admin.')->group(function () {

    ///////////////////////////////          Categories View          ///////////////////////////////

    Route::get('/admin/categories', [AdminDashboardController::class, 'categories'])->name('categories');

    ///////////////////////////////          Add Category          //////////////////////////////

    Route::post('/admin/category/add', [AdminDashboardController::class, 'add_category'])->name('add.category');


    ///////////////////////////////          Delete Category          //////////////////////////////

    Route::delete('/admin/category/delete/{id}', [AdminDashboardController::class, 'delete_category'])->name('delete.category');

    ///////////////////////////////          Edit Category          //////////////////////////////
    Route::get('/admin/category/edit/{id}', [AdminDashboardController::class, 'edit_category_view'])->name('edit.category');
    Route::post('/admin/category/edit/submit/{id}', [AdminDashboardController::class, 'edit_category'])->name('edit.category.submit');
});

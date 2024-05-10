<?php

use App\Http\Controllers\FrontOffice\FrontOfficeController;
use Illuminate\Support\Facades\Route;

Route::get('/category/announcements/{id}', [FrontOfficeController::class, 'category_announcement'])->name('user.category.anouncements');

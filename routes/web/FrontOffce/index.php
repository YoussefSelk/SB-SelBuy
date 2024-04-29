<?php

use App\Http\Controllers\FrontOffice\FrontOfficeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontOfficeController::class, 'index'])->name('home');

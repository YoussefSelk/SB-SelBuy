<?php

use App\Http\Controllers\FrontOffice\FrontOfficeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontOfficeController::class, 'index'])->name('home');
Route::get('/terms-and-conditions', [FrontOfficeController::class, 'terms_and_conditions'])->name('terms.and.conditions');
Route::get('/privacy-policy', [FrontOfficeController::class, 'privacy_policy'])->name('privacy.policy');
Route::get('/about-us', [FrontOfficeController::class, 'about_us'])->name('about.us');

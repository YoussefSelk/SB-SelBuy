<?php

use App\Http\Controllers\FrontOffice\FrontOfficeController;
use Illuminate\Support\Facades\Route;

Route::post('/announcements/{id}/like', [FrontOfficeController::class, 'like']);
Route::get('/announcements/{id}/details', [FrontOfficeController::class, 'announcement_details'])->name('user.annoucement.details');
Route::put('/announcement/{announcement}', [FrontOfficeController::class, 'update_announecement'])->name('user.announcement.update');

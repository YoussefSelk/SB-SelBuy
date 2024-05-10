<?php

use App\Http\Controllers\FrontOffice\FrontOfficeController;
use Illuminate\Support\Facades\Route;

Route::post('/announcements/like', [FrontOfficeController::class, 'like']);
Route::get('/announcements/{id}/details', [FrontOfficeController::class, 'announcement_details'])->name('user.announcement.details');
Route::get('announcement/{id}/images/json', [FrontOfficeController::class, 'getImagesJson'])->name('announcement.images.json');
Route::get('/announcements/filter/json', [FrontOfficeController::class, 'filterAnnouncements'])->name('filter.announcements');


Route::middleware(['auth'])->group(function () {
    Route::put('/announcement/{announcement}', [FrontOfficeController::class, 'update_announcement'])->name('announcement.update');
    Route::delete('/announcement/delete/image/{id}', [FrontOfficeController::class, 'deleteImage'])->name('announcement.deleteImage');
});

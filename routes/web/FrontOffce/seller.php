<?php

use App\Http\Controllers\FrontOffice\FrontOfficeController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {
    Route::get('/become-seller/user/{id}', [FrontOfficeController::class, 'become_seller_view'])->name('user.become.seller.view');
    Route::post('/become-seller/user/submit/{id}', [FrontOfficeController::class, 'become_seller'])->name('user.become.seller.submit');
});
Route::middleware(['auth', 'role:Seller'])->group(function () {
    Route::get('/create/announcement', [FrontOfficeController::class, 'create_announcement_view'])->name('user.create.announcement.view');
    Route::post('/create/announcement/submit', [FrontOfficeController::class, 'create_announcement'])->name('user.create.announcement');
    Route::get('/my-announcement/{id}', [FrontOfficeController::class, 'my_announcement_view'])->name('user.my.announcements.view');
});

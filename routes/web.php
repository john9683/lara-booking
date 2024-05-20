<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::view('/index', 'index');

Route::get('/hotel-list', [HotelController::class, 'indexHotelList'])->middleware(['auth'])->name('hotels');
Route::get('/hotel-show/{id}', [HotelController::class, 'showHotel'])->middleware(['auth']);
Route::get('/available-room-show/{id}', [HotelController::class, 'indexAvailableRoomTypeList'])->middleware(['auth']);

Route::post('/booking-create', [BookingController::class, 'createBooking'])->middleware(['auth']);
Route::get('/booking-list', [BookingController::class, 'indexBookingList'])->middleware(['auth'])->name('bookings');
Route::get('/booking-show/{id}/{cancel?}', [BookingController::class, 'showBooking'])->middleware(['auth']);
Route::post('/booking-cancel', [BookingController::class, 'cancelBooking'])->middleware(['auth']);


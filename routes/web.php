<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingRoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingApproveController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::post('/booking_room', [BookingRoomController::class, 'create'])->name('booking_room.create');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::delete('/delete_room', [RoomController::class, 'delete'])->name('room.delete');

    Route::patch('/booking_approve', [BookingApproveController::class, 'update'])->name('booking_approve.update');
});

require __DIR__ . '/auth.php';

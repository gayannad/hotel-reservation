<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//admin portal
Route::middleware(['auth', 'check-role:admin'])->prefix('admin')
    ->name('admin.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

        //room-types
        Route::prefix('room-types')->name('room-types.')->group(function () {
            Route::get('/', [RoomTypeController::class, 'index'])->name('index');
            Route::get('/create', [RoomTypeController::class, 'create'])->name('create');
            Route::get('/{roomType}/edit', [RoomTypeController::class, 'edit'])->name('edit');
            Route::post('/store', [RoomTypeController::class, 'store'])->name('store');
            Route::put('/update/{roomType}', [RoomTypeController::class, 'update'])->name('update');
            Route::delete('/delete/{roomId}', [RoomTypeController::class, 'destroy'])->name('delete');
        });

        //rooms
        Route::prefix('rooms')->name('rooms.')->group(function () {
            Route::get('/', [RoomController::class, 'index'])->name('index');
            Route::get('/create', [RoomController::class, 'create'])->name('create');
            Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('edit');
            Route::post('/store', [RoomController::class, 'store'])->name('store');
            Route::put('/update/{room}', [RoomController::class, 'update'])->name('update');
            Route::delete('/delete/{roomId}', [RoomController::class, 'destroy'])->name('delete');
        });

        //customers
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/create', [CustomerController::class, 'create'])->name('create');
            Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
            Route::post('/store', [CustomerController::class, 'store'])->name('store');
            Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('update');
            Route::delete('/delete/{customerId}', [CustomerController::class, 'destroy'])->name('delete');
        });
    });

//customer portal
Route::middleware(['auth', 'check-role:customer'])->prefix('customer')
    ->name('customer.')->group(function () {
        Route::get('/home', [HomeController::class, 'customerDashboard'])->name('dashboard');
    });


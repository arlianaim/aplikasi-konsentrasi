<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\facilityController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // if (!auth()->user()->hasRole('admin')) {
    //     return redirect()->route('login');
    // }
    redirect()->route('home');
})->middleware('admin');

// Route::get('/dashboard', function () {
//     redirect()->route('home');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'home'])->name('home');

    //House
    Route::get('/house', [HouseController::class, 'index'])->name('house');
    Route::get('/rooms/{id}', [RoomController::class, 'index'])->name('house.rooms');
    Route::prefix('house')->group(function () {
        Route::get('/detail/{id}', [HouseController::class, 'detail'])->name('house.detail');
        Route::get('/create', [HouseController::class, 'create'])->name('house.create');
        Route::get('/map/{id}', [HouseController::class, 'map'])->name('house.map');
        Route::get('/update/{id}', [HouseController::class, 'update'])->name('house.update');
        Route::post('/store', [HouseController::class, 'store'])->name('house.store');
        Route::put('/set/{id}', [HouseController::class, 'set'])->name('house.set');
        Route::delete('/delete/{id}', [HouseController::class, 'delete'])->name('house.delete');

        //Room
        // Route::get('/room/{house_id}', [RoomController::class, 'index'])->name('room');
        Route::prefix('room')->group(function () {
            Route::get('/create/{house_id}', [RoomController::class, 'create'])->name('room.create');
            Route::get('/update/{house_id}/{id}', [RoomController::class, 'update'])->name('room.update');
            Route::post('/store', [RoomController::class, 'store'])->name('room.store');
            Route::post('/facility/{house_id}/{id}', [RoomController::class, 'facility'])->name('room.facility');
            Route::put('/set/{id}', [RoomController::class, 'set'])->name('room.set');
            Route::delete('/delete/{id}', [RoomController::class, 'delete'])->name('room.delete');

            //Image Per ROOM
            Route::get('/image/{room_id}', [RoomController::class, 'image'])->name('room.image');
            Route::prefix('images')->group(function () {
                Route::get('/create/{room_id}', [RoomController::class, 'image_create'])->name('room.image.create');
                Route::get('/update/{room_id}/{id}', [RoomController::class, 'image_update'])->name('room.image.update');
                Route::post('/store', [RoomController::class, 'image_store'])->name('room.image.store');
                Route::put('/set/{id}', [RoomController::class, 'image_set'])->name('room.image.set');
                Route::delete('/delete/{id}', [RoomController::class, 'image_delete'])->name('room.image.delete');
            });
        });

        //Image
        Route::get('/image/{house_id}', [HouseController::class, 'image'])->name('house.image');
        Route::prefix('image')->group(function () {
            Route::get('/create/{house_id}', [HouseController::class, 'image_create'])->name('image.create');
            Route::get('/update/{house_id}/{id}', [HouseController::class, 'image_update'])->name('image.update');
            Route::post('/store', [HouseController::class, 'image_store'])->name('image.store');
            Route::put('/set/{id}', [HouseController::class, 'image_set'])->name('image.set');
            Route::delete('/delete/{id}', [HouseController::class, 'image_delete'])->name('image.delete');
        });
    });

    // Facility
    Route::get('/facility', [FacilityController::class, 'index'])->name('facility');
    Route::prefix('facility')->group(function () {
        Route::get('/create', [FacilityController::class, 'create'])->name('facility.create');
        Route::get('/update/{id}', [FacilityController::class, 'update'])->name('facility.update');
        Route::post('/store', [FacilityController::class, 'store'])->name('facility.store');
        Route::put('/set/{id}', [FacilityController::class, 'set'])->name('facility.set');
        Route::delete('/delete/{id}', [FacilityController::class, 'delete'])->name('facility.delete');
    });
});

require __DIR__ . '/auth.php';

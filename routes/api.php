<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API
Route::get('/boarding-house-all', [APIController::class, 'getAllBoardingHouse']);
Route::get('/boarding-house-where-type/{type}', [APIController::class, 'getBoardingHouseByType']);
Route::get('/boarding-house-where-search/{search}', [APIController::class, 'getBoardingHouseBySearch']);
Route::get('/boarding-house/{id}', [APIController::class, 'getBoardingHouse']);
Route::get('/facility-all', [APIController::class, 'getAllFacility']);
Route::get('/boarding-house-facility/{id}', [APIController::class, 'getBoardingHouseByFacility']);

Route::get('/check-connection', [APIController::class, 'checkConnection']);

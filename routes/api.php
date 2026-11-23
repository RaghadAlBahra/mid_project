<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::delete('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('myProfile',[AuthController::class,'myProfile'])->middleware('auth:sanctum');



Route::middleware(['auth:sanctum','api_customer'])->prefix('customer')->group(function(){
    
Route::get('bookings',[BookingController::class,'index']);
Route::post('bookings',[BookingController::class,'store']);
Route::get('bookings/{booking}', [BookingController::class, 'show']);
Route::delete('bookings/{booking}/cancel', [BookingController::class, 'cancel']);
// Route::resource('bookings', BookingController::class)->except(['edit', 'update']);


Route::get('centers',[CustomerController::class,'indexCenters']);
Route::get('centers/{center}',[CustomerController::class,'showCenter']);
Route::get('centers/{center}/spaces',[CustomerController::class,'centerSpaces']);


Route::get('spaces/available',[CustomerController::class,'availableSpaces']);
Route::get('spaces/{space}',[CustomerController::class,'showSpace']);


});

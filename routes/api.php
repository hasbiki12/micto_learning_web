<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\BabController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\AuthenticationController;

Route::get('/user_info',[UserController::class, 'index'])->middleware(['auth:sanctum']);   
Route::get('/user_info/{id}',[UserController::class, 'show'])->middleware(['auth:sanctum']);   

Route::get('/logout',[AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);  
Route::get('/dashboard',[DashboardController::class,'dashboard'])->middleware(['auth:sanctum'])->name('dashboard');
Route::get('/me',[AuthenticationController::class, 'me'])->middleware(['auth:sanctum']); 

//mobile
Route::post('/login', [AuthenticationController::class, 'loginMobile']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/materi', [MateriController::class, 'index']);
    Route::get('/materi/{id}', [MateriController::class, 'show']);
    Route::post('/materi', [MateriController::class, 'store']);
    // Route::put('/materi/{id}', [MateriController::class, 'update']);
    Route::patch('/materi/{id}', [MateriController::class, 'update']);
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);    
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/bab', [BabController::class, 'index']);
    Route::post('/bab', [babController::class, 'store']);
    Route::get('/bab/{id}', [BabController::class, 'show']);
    Route::patch('/bab/{id}', [BabController::class, 'update']);
    Route::delete('/bab/{id}', [BabController::class, 'destroy']);    
});
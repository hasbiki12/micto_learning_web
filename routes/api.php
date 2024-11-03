<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;

Route::get('/user_info',[UserController::class, 'index'])->middleware(['auth:sanctum']);   
Route::get('/user_info/{id}',[UserController::class, 'show'])->middleware(['auth:sanctum']);   

Route::post('/login',[AuthenticationController::class, 'login']);
Route::get('/logout',[AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);  
Route::get('/dashboard',[DashboardController::class,'dashboard'])->middleware(['auth:sanctum'])->name('dashboard');
Route::get('/me',[AuthenticationController::class, 'me'])->middleware(['auth:sanctum']); 

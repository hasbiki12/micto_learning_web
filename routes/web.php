<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'showLoginPage'])->name('login');
Route::post('/', [AuthenticationController::class, 'login'])->name('login_post');
Route::post('/logout', [AuthenticationController::class, 'logoutWeb'])->name('logoutWeb');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth')->name('dashboard');
;
Route::get('/siswa', [SiswaController::class, 'siswaPage'])->name('siswaPage');

Route::get('/add_user', [UserController::class, 'create']);
Route::get('/edit_user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users', [UserController::class, 'store'])->name('users.store');


Route::get('/guru', [GuruController::class, 'guruPage'])->name('guruPage');
Route::get('/edit_guru/{id}', [UserController::class, 'editGuru'])->name('guru.editGuru');
Route::put('/guru/{id}', [UserController::class, 'updateGuru'])->name('guru.updateGuru');
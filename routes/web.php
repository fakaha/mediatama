<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store'])->name('auth.register');

Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
Route::post('/video', [VideoController::class, 'store'])->name('video.store');
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');
Route::delete('/video/{id}', [VideoController::class, 'delete'])->name('video.delete');
Route::get('/video/{id}/edit', [VideoController::class, 'edit'])->name('video.edit');
Route::put('/video/{id}', [VideoController::class, 'update'])->name('video.update');

Route::get('/users', [UserController::class,'index'])->name('user.index');
Route::get('/users/create', [UserController::class,'create'])->name('user.create');
Route::post('/users/store', [UserController::class,'store'])->name('user.store');
Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('user.edit');
Route::put('/users/{id}', [UserController::class,'update'])->name('user.update');
Route::delete('/users/{id}', [UserController::class,'delete'])->name('user.delete');
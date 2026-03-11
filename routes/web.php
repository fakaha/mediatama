<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoAccessRequestController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store'])->name('auth.register');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/video', [VideoController::class, 'index'])->name('video.index')->middleware('auth');
Route::get('/video/create', [VideoController::class, 'create'])->name('video.create')->middleware('auth');
Route::post('/video', [VideoController::class, 'store'])->name('video.store')->middleware('auth');
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show')->middleware('auth');
Route::delete('/video/{id}', [VideoController::class, 'delete'])->name('video.delete')->middleware('auth');
Route::get('/video/{id}/edit', [VideoController::class, 'edit'])->name('video.edit')->middleware('auth');
Route::put('/video/{id}', [VideoController::class, 'update'])->name('video.update')->middleware('auth');
Route::post('/video/request', [VideoController::class,'requestAccess'])->name('video.request')->middleware('auth');

Route::get('/video-request',[VideoAccessRequestController::class,'index'])->name('video.request.index')->middleware('auth');
Route::post('/video-request/{id}/approve',[VideoAccessRequestController::class,'approve'])->name('video.request.approve')->middleware('auth');

Route::get('/users', [UserController::class,'index'])->name('user.index')->middleware('auth');
Route::get('/users/create', [UserController::class,'create'])->name('user.create')->middleware('auth');
Route::post('/users/store', [UserController::class,'store'])->name('user.store')->middleware('auth');
Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('user.edit')->middleware('auth');
Route::put('/users/{id}', [UserController::class,'update'])->name('user.update')->middleware('auth');
Route::delete('/users/{id}', [UserController::class,'delete'])->name('user.delete')->middleware('auth');
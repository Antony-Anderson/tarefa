<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'telaLogin'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');


Route::get('/{path?}', [SpaController::class, 'index'])->where('path', '.*')->name('spa.index');
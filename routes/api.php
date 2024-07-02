<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KodamController;

Route::get('kodam', [KodamController::class, 'index']);
Route::get('kodam/{id}', [KodamController::class, 'show']);
Route::post('kodam', [KodamController::class, 'store']);
Route::put('kodam/{id}', [KodamController::class, 'update']);
Route::delete('kodam/{id}', [KodamController::class, 'destroy']);


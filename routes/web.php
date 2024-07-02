<?php

use App\Http\Controllers\KodamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [KodamController::class, 'showForm']);
Route::post('/', [KodamController::class, 'generateKodam']);

Route::get('kodam', [KodamController::class, 'kodamIndex']);
Route::get('kodam/{id}', [KodamController::class, 'show']);
Route::post('kodam', [KodamController::class, 'store']);
Route::put('kodam/{id}', [KodamController::class, 'update']);
Route::delete('kodam/{id}', [KodamController::class, 'destroy']);

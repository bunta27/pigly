<?php

use App\Http\Controllers\WeightController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login',[UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [WeightController::class, 'index'])->name('admin');

    Route::get('/weight_logs/{log}', [WeightController::class, 'show'])->name('weight_logs.show');

    Route::patch('/weight_logs/{log}', [WeightController::class, 'update'])->name('weight_logs.update');

    Route::delete('/weight_logs/{log}', [WeightController::class, 'destroy'])->name('weight_logs.destroy');

    Route::get('/target', [WeightController::class, 'editTarget'])->name('target.edit');
    Route::patch('/target', [WeightController::class, 'updateTarget'])->name('target.update');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});


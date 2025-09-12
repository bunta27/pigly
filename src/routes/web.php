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
Route::get('/register/step1',[UserController::class, 'showRegisterStep1'])->name('register.step1');
Route::post('/register/step1',[UserController::class, 'storeStep1'])->name('register.step1.store');

Route::get('/register/step2',[UserController::class, 'showRegisterStep2'])->name('register.step2');
Route::post('/register/step2',[UserController::class, 'storeStep2'])->name('register.step2.store');

Route::get('/login',[UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightController::class, 'index'])->name('admin');

    Route::prefix('weight_logs')->group(function () {
        Route::get('{weightLogId}',   [WeightController::class, 'show'])->name('weight_logs.show');
        Route::patch('{weightLogId}', [WeightController::class, 'update'])->name('weight_logs.update');
        Route::delete('{weightLogId}',[WeightController::class, 'destroy'])->name('weight_logs.destroy');
        Route::get('goal_setting',  [WeightController::class, 'editTarget'])->name('target.edit');
        Route::patch('goal_setting',[WeightController::class, 'updateTarget'])->name('target.update');
    });

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});


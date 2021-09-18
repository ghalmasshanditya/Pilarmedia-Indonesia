<?php

use App\Http\Controllers\AbsentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AbsentnController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
// Route::get('/permission', [UserController::class, 'index'])->name('permission');
Route::get('/absents', [AbsentController::class, 'index'])->name('absents');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile/update/{id}', [UserController::class, 'update'])->name('profile-update');
    Route::post('/profile/change-profile/{id}', [UserController::class, 'updateProfile'])->name('profile-foto');
});

Route::middleware(['auth', 'level:1'])->group(function () {
});

Route::middleware(['auth', 'level:1,2'])->group(function () {
});

Route::middleware(['auth', 'level:3'])->group(function () {
    Route::get('/absents', [AbsentController::class, 'index'])->name('absents');
    Route::post('/absents/check/{id}', [AbsentController::class, 'check'])->name('absents.check');
    Route::get('/permissions', [UserController::class, 'index'])->name('permissions');
});
require __DIR__ . '/auth.php';

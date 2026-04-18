<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Admin Dashboard ";
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
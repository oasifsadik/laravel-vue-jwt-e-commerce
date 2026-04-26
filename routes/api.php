<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->name('api.v1.')->group(function () {
 
    // ── Categories ─────────────────────────────────────────────────────────
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/',           [CategoryController::class, 'index'])->name('index');
        Route::get('/{slug}',     [CategoryController::class, 'show'])->name('show');
        Route::get('/{slug}/sub-categories', [CategoryController::class, 'subCategories'])->name('sub-categories');
    });
 
    // ── Sub-Categories ─────────────────────────────────────────────────────
    Route::prefix('sub-categories')->name('sub-categories.')->group(function () {
        Route::get('/',             [SubCategoryController::class, 'index'])->name('index');
        Route::get('/{slug}',       [SubCategoryController::class, 'show'])->name('show');
        Route::get('/{slug}/products', [SubCategoryController::class, 'products'])->name('products');
    });
 
    // ── Products ───────────────────────────────────────────────────────────
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/',          [ProductController::class, 'index'])->name('index');
        Route::get('/featured',  [ProductController::class, 'featured'])->name('featured');
        Route::get('/{slug}',    [ProductController::class, 'show'])->name('show');
    });
 
});


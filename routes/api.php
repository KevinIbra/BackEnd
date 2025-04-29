<?php

use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\BarangUnggahanController;
use App\Http\Controllers\IdeKerajinanController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Route;


    // Public routes
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/test', function() {
        return response()->json(['message' => 'API v1 is working']);
    });

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // User routes
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);

        // Other protected resources with consistent kebab-case naming
        Route::apiResource('notifikasi', NotifikasiController::class);
        Route::apiResource('rekomendasi', RekomendasiController::class);
        Route::apiResource('tutorial', TutorialController::class);
        Route::apiResource('ide-kerajinan', IdeKerajinanController::class);
        Route::apiResource('favorit', FavoritController::class);
        Route::apiResource('barang-unggahan', BarangUnggahanController::class);
        Route::apiResource('analisis-ai', AnalisisController::class);
    });




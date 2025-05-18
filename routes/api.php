<?php

use App\Http\Controllers\BarangUnggahanController;
use App\Http\Controllers\IdeKerajinanController;
use App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->group(function () {
    Route::get('/test', function() {
        return response()->json(['message' => 'API v1 is working']);
    });



    Route::apiResource('barang-unggahan', BarangUnggahanController::class);
    Route::apiResource('ide-kerajinan', IdeKerajinanController::class);
    Route::apiResource('tutorial', TutorialController::class);
});





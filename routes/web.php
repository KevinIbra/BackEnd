<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->middleware('api')->group(function () {
    require base_path('routes/api.php');
});

// Default route
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
        'status' => 'running'
    ]);
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()
    ]);
});

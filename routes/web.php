<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangUnggahanController;

// Include API routes without adding another prefix
require base_path('routes/api.php');

// Health Check Routes
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to Craft API',
        'version' => '1.0',
        'resources' => [
            'ide-kerajinan',
            'barang-unggahan',
            'tutorial'
        ]
    ]);
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now(),
        'database' => 'connected'
    ]);
});



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Példa egy egyszerű API végpontra
Route::get('/status', function () {
    return response()->json(['status' => 'API működik']);
});

Route::get('getRooms', [App\Http\Controllers\ApiController::class, 'getRooms']);

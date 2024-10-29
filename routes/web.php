<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/chatek', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index')->middleware('auth');



Route::get('getRooms', [App\Http\Controllers\ApiController::class, 'getRooms'])->name('getRooms');
Route::post('setRoomMessage', [App\Http\Controllers\ChatRoomController::class, 'setRoomMessage'])->name('setRoomMessage');

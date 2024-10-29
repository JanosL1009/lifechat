<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profil', [App\Http\Controllers\ProfileController::class, 'index'])->name('felhasznalo.profil')->middleware('auth');
Route::post('/profil-modositas/{id}/post', [App\Http\Controllers\ProfileController::class, 'EditProfile'])->name('felhasznalo.profil.modositas')->middleware('auth');

Route::get('/chatek', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index')->middleware('auth');



Route::get('getRooms', [App\Http\Controllers\ApiController::class, 'getRooms'])->name('getRooms');
Route::post('setRoomMessage', [App\Http\Controllers\ChatRoomController::class, 'setRoomMessage'])->name('setRoomMessage');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('room-list', [App\Http\Controllers\ChatRoomController::class, 'adminRoomList'])->name('roomlist');

    Route::get('room/new', [App\Http\Controllers\ChatRoomController::class, 'NewRoom'])->name('NewRoom');
    Route::post('room/create', [App\Http\Controllers\ChatRoomController::class, 'CreateNewRoom'])->name('CreateNewRoom');


});
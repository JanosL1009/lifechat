<?php

use App\Http\Controllers\SearchUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profil', [App\Http\Controllers\ProfileController::class, 'index'])->name('felhasznalo.profil')->middleware('auth');
Route::post('/profil-modositas/{id}/post', [App\Http\Controllers\ProfileController::class, 'EditProfile'])->name('felhasznalo.profil.modositas')->middleware('auth');

Route::get('/chatek', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index')->middleware('auth');
Route::get('/chat/szoba/{roomid}', [App\Http\Controllers\ChatController::class, 'generalRoom'])->name('chat.generalRoom')->middleware('auth');
Route::get('/chat/privat/{roomid}', [App\Http\Controllers\ChatController::class, 'privateRoom'])->name('chat.privateRoom')->middleware('auth');

Route::get('getRooms', [App\Http\Controllers\ApiController::class, 'getRooms'])->name('getRooms')->middleware('auth');
Route::post('getRoomData', [App\Http\Controllers\ApiController::class, 'getRoomData'])->name('getRoomData')->middleware('auth');
Route::post('setRoomMessage', [App\Http\Controllers\ChatRoomController::class, 'setRoomMessage'])->name('setRoomMessage')->middleware('auth');

Route::get('rooms', [App\Http\Controllers\ChatRoomController::class, 'getRoomList'])->name('get.rooms.list');

Route::get('user/generalinfo/{userid}', [App\Http\Controllers\ProfileController::class, 'userView'])->name('get.user.view');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('room-list', [App\Http\Controllers\ChatRoomController::class, 'adminRoomList'])->name('roomlist');

    Route::get('room/new', [App\Http\Controllers\ChatRoomController::class, 'NewRoom'])->name('NewRoom');
    Route::post('room/create/post', [App\Http\Controllers\ChatRoomController::class, 'CreateNewRoom'])->name('room.createnew.post');

    
    Route::get('room/update/{id}', [App\Http\Controllers\ChatRoomController::class, 'GetUpdateRoom'])->name('update.room');
    Route::post('room/update/{id}', [App\Http\Controllers\ChatRoomController::class, 'UpdateRoom'])->name('update.room.post');

    Route::get('szemely_kereses',[App\Http\Controllers\SearchUserController::class, 'search'])->name('szemely.kereses')->middleware('auth');
    Route::get('szemely/szerkesztes/{id}', [App\Http\Controllers\SearchUserController::class, 'edit'])->name('szemely.szerkesztes');
    Route::post('szemely/szerkesztes/{id}/post', [App\Http\Controllers\SearchUserController::class, 'EditProfile_Post'])->name('szemely.szerkesztes.post');

    Route::get('tags', [App\Http\Controllers\TagController::class, 'index'])->name('tags.list');
    Route::get('tags-create', [App\Http\Controllers\TagController::class, 'create'])->name('tags.create');
    Route::post('tags-create/post', [App\Http\Controllers\TagController::class, 'create_post'])->name('tags.create.post');
    Route::get('tags-edit/{id}', [App\Http\Controllers\TagController::class, 'Edit'])->name('tags.edit');
    Route::post('tags-edit/post', [App\Http\Controllers\TagController::class, 'Edit_Post'])->name('tags.edit.post');

});
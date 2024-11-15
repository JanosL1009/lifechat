<?php

use App\Http\Controllers\SearchUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/aszf', [App\Http\Controllers\PageController::class, 'ASZF'])->name('aszf');
Route::get('/privacy-policy', [App\Http\Controllers\PageController::class, 'PrivPolicy'])->name('privacy.policy');

Route::get('/profil', [App\Http\Controllers\ProfileController::class, 'index'])->name('felhasznalo.profil')->middleware('auth');
Route::post('/profil-modositas/{id}/post', [App\Http\Controllers\ProfileController::class, 'EditProfile'])->name('felhasznalo.profil.modositas')->middleware('auth');

Route::get('/chatek', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index')->middleware('auth');
Route::get('/chat/szoba/{roomid}', [App\Http\Controllers\ChatController::class, 'generalRoom'])->name('chat.generalRoom')->middleware('auth');
Route::get('/chat/privat/{roomid}', [App\Http\Controllers\ChatController::class, 'privateRoom'])->name('chat.privateRoom')->middleware('auth');
Route::post('chat/upload-image', [App\Http\Controllers\ChatController::class, 'upload'])->name('upload.image')->middleware('auth');


Route::get('getRooms', [App\Http\Controllers\ApiController::class, 'getRooms'])->name('getRooms')->middleware('auth')->middleware('auth');
Route::post('getRoomData', [App\Http\Controllers\ApiController::class, 'getRoomData'])->name('getRoomData')->middleware('auth')->middleware('auth');
Route::post('setRoomMessage', [App\Http\Controllers\ChatRoomController::class, 'setRoomMessage'])->name('setRoomMessage')->middleware('auth')->middleware('auth');

Route::get('rooms', [App\Http\Controllers\ChatRoomController::class, 'getRoomList'])->name('get.rooms.list')->middleware('auth');

Route::get('user/generalinfo/{userid}', [App\Http\Controllers\ProfileController::class, 'userView'])->name('get.user.view')->middleware('auth');

Route::post('enteringChatRoom/post', [App\Http\Controllers\ChatRoomController::class, 'enteringChatRoom'])->name('enteringChatRoom.post')->middleware('auth')->middleware('auth');
Route::post('exitChatRoom/post', [App\Http\Controllers\ChatRoomController::class, 'exitChatRoom'])->name('exitChatRoom.post')->middleware('auth')->middleware('auth');
Route::post('getUsersFromRoom/post', [App\Http\Controllers\ApiController::class, 'getRoomUsers'])->name('getRoomUsers.post')->middleware('auth')->middleware('auth');

Route::post('getRadiList/post', [App\Http\Controllers\ApiController::class, 'getRadioList'])->name('getRadioList')->middleware('auth')->middleware('auth');

Route::post('xhr/room/content', [App\Http\Controllers\ApiController::class, 'loadRoomContent'])->name('xhr.rooms.list')->middleware('auth');


//userek bannolasa az altalnos szobakbol
Route::post('chat/user/ban/set', [App\Http\Controllers\ApiController::class, 'setUserban'])->name('Userban.Ban')->middleware('auth');
Route::post('chat/user/ban/unban', [App\Http\Controllers\ApiController::class, 'setUserUnban'])->name('Userban.Unban')->middleware('auth');
//baratok listaja - elküldött meghivok listaja
Route::get('friends', [App\Http\Controllers\FriendsController::class, 'index'])->name('friends.index')->middleware('auth');

// baratmeghivok megjelenitese, fogadasa, elutasitasa
Route::get('/friend/requests', [App\Http\Controllers\FriendsController::class, 'incomingRequests'])->name('friend.requests')->middleware('auth');
Route::post('/friend/request/accept/{id}', [App\Http\Controllers\FriendsController::class, 'acceptRequest']);
Route::post('/friend/request/reject/{id}', [App\Http\Controllers\FriendsController::class, 'rejectRequest']);


// elkuldi a baratmeghivot
Route::post('/friend/request', [App\Http\Controllers\FriendsController::class, 'sendRequest'])->name('friend.request');
// megszamolja hany barat felkeresünk van
Route::get('/friend/requests/count', [App\Http\Controllers\FriendsController::class, 'countRequests'])->name('friend.requests.count')->middleware('auth');

//baratkerelem visszavonasa
Route::post('/friend/request/cancel/{id}', [App\Http\Controllers\FriendsController::class, 'cancelFriendRequest'])->name('friend.request.cancel');
//barat eltavolitasa
Route::post('/friend/delete/{id}', [App\Http\Controllers\FriendsController::class, 'deleteFriend'])->name('friend.delete');
Route::post('/friend/request/cancel/{id}', [App\Http\Controllers\FriendsController::class, 'cancelRequest'])->name('friend.request.cancel');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('room-list', [App\Http\Controllers\ChatRoomController::class, 'adminRoomList'])->name('roomlist')->middleware('auth')->middleware('auth');

    Route::get('room/new', [App\Http\Controllers\ChatRoomController::class, 'NewRoom'])->name('NewRoom')->middleware('auth');
    Route::post('room/create/post', [App\Http\Controllers\ChatRoomController::class, 'CreateNewRoom'])->name('room.createnew.post')->middleware('auth');

    
    Route::get('room/update/{id}', [App\Http\Controllers\ChatRoomController::class, 'GetUpdateRoom'])->name('update.room')->middleware('auth');
    Route::post('room/update/{id}', [App\Http\Controllers\ChatRoomController::class, 'UpdateRoom'])->name('update.room.post')->middleware('auth');

    Route::get('room/operators/{room_id}', [App\Http\Controllers\RoomOperatorsController::class, 'selectOperator'])->name('operators.add')->middleware('auth');
    Route::post('room/operators/add/post', [App\Http\Controllers\RoomOperatorsController::class, 'addOperator'])->name('operators.create.post')->middleware('auth');
    Route::post('room/operators/remove/post', [App\Http\Controllers\RoomOperatorsController::class, 'removeOperator'])->name('operators.remove.post')->middleware('auth');

    Route::get('szemely_kereses',[App\Http\Controllers\SearchUserController::class, 'search'])->name('szemely.kereses')->middleware('auth');
    Route::get('szemely/szerkesztes/{id}', [App\Http\Controllers\SearchUserController::class, 'edit'])->name('szemely.szerkesztes')->middleware('auth');
    Route::post('szemely/szerkesztes/{id}/post', [App\Http\Controllers\SearchUserController::class, 'EditProfile_Post'])->name('szemely.szerkesztes.post')->middleware('auth');

    Route::get('tags', [App\Http\Controllers\TagController::class, 'index'])->name('tags.list')->middleware('auth');
    Route::get('tags-create', [App\Http\Controllers\TagController::class, 'create'])->name('tags.create')->middleware('auth');
    Route::post('tags-create/post', [App\Http\Controllers\TagController::class, 'create_post'])->name('tags.create.post')->middleware('auth');
    Route::get('tags-edit/{id}', [App\Http\Controllers\TagController::class, 'Edit'])->name('tags.edit')->middleware('auth');
    Route::post('tags-edit/post', [App\Http\Controllers\TagController::class, 'Edit_Post'])->name('tags.edit.post')->middleware('auth');

    Route::get('pages', [App\Http\Controllers\PageController::class, 'Index'])->name('pages.index');
    Route::get('pages-edit/{id}', [App\Http\Controllers\PageController::class, 'Edit_Pages'])->name('pages.edit')->middleware('auth');
    Route::post('pages-edit/{id}/post', [App\Http\Controllers\PageController::class, 'Edit_Pages_Post'])->name('pages.edit.post')->middleware('auth');

    Route::get('user-ip-list', [App\Http\Controllers\UserLogsController::class, 'UserIpList'])->name('UserLogs.IpList')->middleware('auth');
    Route::get('user-ip-list/export', [App\Http\Controllers\UserLogsController::class, 'export'])->name('UserLogs.export')->middleware('auth');
   
    Route::get('search-user-ip', [App\Http\Controllers\UserLogsController::class, 'searchbyuser'])->name('UserLogs.search.user.list')->middleware('auth');
    Route::get('user/{userId}/export', [App\Http\Controllers\UserLogsController::class, 'exportUserData'])->name('userlogs.export.byuserid')->middleware('auth');

    Route::get('radios', [App\Http\Controllers\RadioController::class, 'index'])->name('radio.index')->middleware('auth');
    Route::get('radio/add', [App\Http\Controllers\RadioController::class, 'Create'])->name('radio.create')->middleware('auth');
    Route::post('radio/add/post', [App\Http\Controllers\RadioController::class, 'Create_Post'])->name('radio.create.post')->middleware('auth');

    Route::get('radio/edit/{id}', [App\Http\Controllers\RadioController::class, 'Edit'])->name('radio.edit');
    Route::post('radio/edit/post', [App\Http\Controllers\RadioController::class, 'Edit_Post'])->name('radio.edit.post')->middleware('auth');
    Route::post('radio/delete/post', [App\Http\Controllers\RadioController::class, 'Delete'])->name('radio.delete.post')->middleware('auth');

    Route::get('banned/list', [App\Http\Controllers\ChatController::class, 'BannedList'])->name('banned.list.index')->middleware('auth');
    Route::post('unban/post', [App\Http\Controllers\ChatController::class, 'UnBan_Post'])->name('banned.unban.post')->middleware('auth');

    
})->middleware('auth');
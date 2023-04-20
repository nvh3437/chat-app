<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('chat')->group(function () {
    Route::get('/', 'AvnChatController@index')->middleware(['auth', 'lastactivity'])->name('chat-index');
    Route::get('/get-messages', 'AvnChatController@getMessages')->middleware(['auth', 'lastactivity'])->name('get-messages');
    Route::get('/get-room-info', 'AvnChatController@getRoomInfo')->middleware(['auth', 'lastactivity'])->name('get-room-info');
    Route::post('/send-message', 'AvnChatController@sendMessage')->middleware('auth', 'lastactivity')->name('send-message-to-user');
    Route::post('/join-room', 'AvnChatController@joinRoom')->middleware('auth', 'lastactivity')->name('join-room-chat');
    Route::post('/add-users', 'AvnChatController@addUsers')->middleware('auth', 'lastactivity')->name('add-users-chat');
    Route::post('/kick-user', 'AvnChatController@kickUser')->middleware('auth', 'lastactivity')->name('kick-user-chat');
    Route::post('/start-session', 'AvnChatController@startSession')->middleware('auth', 'lastactivity')->name('start-session-chat');
    Route::post('/end-session', 'AvnChatController@endSession')->middleware('auth', 'lastactivity')->name('end-session-chat');
});
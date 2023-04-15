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
    Route::get('/', 'AvnChatController@index')->middleware(['auth'])->name('chat-index');
    Route::get('/get-messages', 'AvnChatController@getMessages')->middleware(['auth'])->name('get-messages');
    Route::get('/get-room-info', 'AvnChatController@getRoomInfo')->middleware(['auth'])->name('get-room-info');
    Route::post('/send-message', 'AvnChatController@sendMessage')->middleware('auth')->name('send-message-to-user');
    Route::post('/join-room', 'AvnChatController@joinRoom')->middleware('auth')->name('join-room-chat');
});
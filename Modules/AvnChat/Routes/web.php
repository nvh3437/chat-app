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
    Route::get('/', 'AvnChatController@index')->middleware(['auth']);
    Route::get('/get-messages', 'AvnChatController@getMessages')->middleware(['auth'])->name('get-messages');
    Route::post('/send-message', 'AvnChatController@sendMessage')->middleware('auth')->name('send-message-to-user');
});
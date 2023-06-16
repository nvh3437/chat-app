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
    // chat
    Route::get('/', 'AvnChatController@index')->middleware(['auth', 'lastactivity'])->name('chat-index');
    Route::get('/get-miss-messages', 'AvnChatController@getMissMessage')->middleware(['auth', 'lastactivity'])->name('get-miss-message');
    Route::get('/load-messages', 'AvnChatController@loadMessages')->middleware(['auth', 'lastactivity'])->name('load-messages');
    Route::get('/get-messages', 'AvnChatController@getMessages')->middleware(['auth', 'lastactivity'])->name('get-messages');
    Route::get('/get-room-info', 'AvnChatController@getRoomInfo')->middleware(['auth'])->name('get-room-info');
    Route::get('/get-customers', 'AvnChatController@getCustomers')->middleware(['auth'])->name('get-customers');
    Route::post('/update-room-chat', 'AvnChatController@updateRoomChat')->middleware(['auth', 'lastactivity'])->name('update-room-chat');
    Route::post('/received-message', 'AvnChatController@receivedMessage')->middleware(['auth', 'lastactivity'])->name('received-message-to-user');
    Route::post('/send-message', 'AvnChatController@sendMessage')->middleware(['auth', 'lastactivity'])->name('send-message-to-user');
    Route::post('/join-room', 'AvnChatController@joinRoom')->middleware(['auth', 'lastactivity'])->name('join-room-chat');
    Route::post('/add-users', 'AvnChatController@addUsers')->middleware(['auth', 'lastactivity'])->name('add-users-chat');
    Route::post('/kick-user', 'AvnChatController@kickUser')->middleware(['auth', 'lastactivity'])->name('kick-user-chat');
    Route::post('/start-session', 'AvnChatController@startSession')->middleware(['auth', 'lastactivity'])->name('start-session-chat');
    Route::post('/end-session', 'AvnChatController@endSession')->middleware(['auth', 'lastactivity'])->name('end-session-chat');
    // order
    Route::get('/order', 'AvnChatOrderController@orderChat')->middleware(['auth'])->name('order-chat');
    Route::post('/store-order', 'AvnChatOrderController@storeOrderChat')->name('store-order-chat');
    Route::get('/list-order', 'AvnChatOrderController@listOrder')->middleware(['auth'])->middleware(['auth', 'permission'])->name('list-order');
    Route::put('/process-order/{id}', 'AvnChatOrderController@processOrder')->middleware(['auth', 'permission'])->name('process-order');
    Route::delete('/delete-order/{id}', 'AvnChatOrderController@deleteOrder')->middleware(['auth', 'permission'])->name('delete-order');
    // session
    Route::get('/session', 'AvnChatSessionController@listSession')->middleware(['auth', 'permission'])->name('list-session');
    Route::get('/session/users', 'AvnChatSessionController@listSessionUser')->middleware(['auth'])->name('list-session-user');
    Route::put('/process-session/{id}', 'AvnChatSessionController@processSession')->middleware(['auth', 'permission'])->name('process-session');
    // call
    Route::post('/start-call', 'AvnCallController@startCall')->middleware(['auth', 'lastactivity'])->name('start-call');
    Route::post('/end-call', 'AvnCallController@endCall')->middleware(['auth', 'lastactivity'])->name('end-call');
    Route::post('/janus-event', 'AvnCallController@janusEvent')->middleware(['auth.basic'])->name('janus-event');



});
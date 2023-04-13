<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/avnchat/send-message', function (Request $request) {
    $message = $request->message;
    $username = $request->username;
    broadcast(new App\Events\SendMessage( $username, $message ));
})->middleware(['auth:sanctum']);
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

Route::prefix('attendance-auto')->group(function () {
    Route::any('/handle-timekeeping', 'AvnAttendanceAutoApiController@handleTimekeeping')->name('attendance-auto-handle-timekeeping');
});

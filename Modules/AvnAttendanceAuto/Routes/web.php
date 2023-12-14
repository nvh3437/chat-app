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

Route::prefix('attendance-auto')->group(function () {
    Route::get('/', 'AvnAttendanceAutoController@index');
    Route::any('/handle-timekeeping', 'AvnAttendanceAutoController@handleTimekeeping')->name('attendance-auto-handle-timekeeping');

});

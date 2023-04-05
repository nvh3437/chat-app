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

Route::prefix('service')->group(function() {
    Route::get('/list-type', 'AvnServiceTypeController@listType')->name('list-type');
    Route::post('/store-type', 'AvnServiceTypeController@storeType')->name('store-type');
    Route::put('/update-type/{id}', 'AvnServiceTypeController@updateType')->name('update-type');
    Route::delete('/delete-type/{id}', 'AvnServiceTypeController@deleteType')->name('delete-type');
});

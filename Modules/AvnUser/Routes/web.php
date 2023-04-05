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

Route::prefix('user')->group(function() {

    // Chuyên gia
    Route::get('/list-partern', 'ParternController@listPartern')->name('list-partern');
    Route::get('/add-partern', 'ParternController@addPartern')->name('add-partern');
    Route::get('/edit-partern/{id}', 'ParternController@editPartern')->name('edit-partern');
    Route::post('/store-partern', 'ParternController@storePartern')->name('store-partern');
    Route::put('/update-partern/{id}', 'ParternController@updatePartern')->name('update-partern');
    Route::delete('/delete-partern/{id}', 'ParternController@deletePartern')->name('delete-partern');
});

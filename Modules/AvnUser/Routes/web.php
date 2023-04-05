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
    Route::get('/list-partern', 'ParternController@listPartern')->middleware(['auth', 'permission'])->name('list-partern');
    Route::get('/add-partern', 'ParternController@addPartern')->middleware(['auth', 'permission'])->name('add-partern');
    Route::get('/edit-partern/{id}', 'ParternController@editPartern')->middleware(['auth', 'permission'])->name('edit-partern');
    Route::post('/store-partern', 'ParternController@storePartern')->middleware(['auth', 'permission'])->name('store-partern');
    Route::put('/update-partern/{id}', 'ParternController@updatePartern')->middleware(['auth', 'permission'])->name('update-partern');
    Route::delete('/delete-partern/{id}', 'ParternController@deletePartern')->middleware(['auth', 'permission'])->name('delete-partern');

    // Khách
    Route::get('/list-customer', 'CustomerController@listCustomer')->middleware(['auth', 'permission'])->name('list-customer');
    Route::get('/add-customer', 'CustomerController@addCustomer')->middleware(['auth', 'permission'])->name('add-customer');
    Route::get('/edit-customer/{id}', 'CustomerController@editCustomer')->middleware(['auth', 'permission'])->name('edit-customer');
    Route::post('/store-customer', 'CustomerController@storeCustomer')->middleware(['auth', 'permission'])->name('store-customer');
    Route::put('/update-customer/{id}', 'CustomerController@updateCustomer')->middleware(['auth', 'permission'])->name('update-customer');
    Route::delete('/delete-customer/{id}', 'CustomerController@deleteCustomer')->middleware(['auth', 'permission'])->name('delete-customer');
});

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

Route::prefix('setting')->group(function() {

    // Navbar
    Route::get('/list-navbar', 'NavbarController@listNavbar')->middleware(['auth', 'permission'])->name('list-navbar');
    Route::get('/edit-navbar/{id}', 'NavbarController@editNavbar')->middleware(['auth', 'permission'])->name('edit-navbar');
    Route::post('/store-navbar', 'NavbarController@storeNavbar')->middleware(['auth', 'permission'])->name('store-navbar');
    Route::put('/update-navbar/{id}', 'NavbarController@updateNavbar')->middleware(['auth', 'permission'])->name('update-navbar');
    Route::delete('/delete-navbar/{id}', 'NavbarController@deleteNavbar')->middleware(['auth', 'permission'])->name('delete-navbar');
});

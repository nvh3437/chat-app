<?php
use Modules\AvnContact\Http\Controllers\ContactController;

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

Route::prefix('contact')->group(function () {

    //---------------------- Quản lý ----------------------//
    Route::get('/list-contact', 'ContactController@listContact')->middleware(['auth', 'permission'])->name('list-contact');
    Route::put('/process-contact/{id}', 'ContactController@processContact')->middleware(['auth', 'permission'])->name('process-contact');
    Route::delete('/delete-contact/{id}', 'ContactController@deleteContact')->middleware(['auth', 'permission'])->name('delete-contact');
    //----------------------- Khách -----------------------//
    Route::post('/store', [ContactController::class, 'storeContact'])->name('store-contact');
    Route::get('/{success?}', [ContactController::class, 'contactPage'])->name('contact-page');
});
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

//---------------------- Quản lý ----------------------//
Route::prefix('')->group(function() {
    Route::get('/list-contact', 'ContactController@listContact')->middleware(['auth', 'permission'])->name('list-contact');
    Route::delete('/delete-contact/{id}', 'ContactController@deleteContact')->middleware(['auth', 'permission'])->name('delete-contact');
});

//----------------------- Khách -----------------------//
Route::get('/page-contact', [ContactController::class, 'pageContact'])->name('page-contact');
Route::get('/success-contact', [ContactController::class, 'successContact'])->name('success-contact');
Route::post('/store-contact', [ContactController::class, 'storeContact'])->name('store-contact');
<?php
use Modules\AvnCMS\Http\Controllers\CMSController;
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

//------------------------------------- Quản lý ---------------------//
Route::prefix('cms')->group(function() {
    // Bài viết
    Route::get('/list-cms', 'CMSController@listCMS')->middleware(['auth', 'permission'])->name('list-cms');
    Route::get('/add-cms', 'CMSController@addCMS')->middleware(['auth', 'permission'])->name('add-cms');
    Route::get('/edit-cms/{id}', 'CMSController@editCMS')->middleware(['auth', 'permission'])->name('edit-cms');
    Route::post('/store-cms', 'CMSController@storeCMS')->middleware(['auth', 'permission'])->name('store-cms');
    Route::put('/update-cms/{id}', 'CMSController@updateCMS')->middleware(['auth', 'permission'])->name('update-cms');
    Route::delete('/delete-cms/{id}', 'CMSController@deleteCMS')->middleware(['auth', 'permission'])->name('delete-cms');
});

//------------------------------------- Trang CMS ---------------------//
Route::get('cms/{link}', [CMSController::class, 'cmsPage'])->name('cms-page');

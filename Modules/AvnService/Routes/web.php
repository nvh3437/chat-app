<?php
use Modules\AvnService\Http\Controllers\AvnServiceController;

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

    // Loại dịch vụ
    Route::get('/list-type', 'AvnServiceTypeController@listType')->middleware(['auth', 'permission'])->name('list-type');
    Route::post('/store-type', 'AvnServiceTypeController@storeType')->middleware(['auth', 'permission'])->name('store-type');
    Route::put('/update-type/{id}', 'AvnServiceTypeController@updateType')->middleware(['auth', 'permission'])->name('update-type');
    Route::delete('/delete-type/{id}', 'AvnServiceTypeController@deleteType')->middleware(['auth', 'permission'])->name('delete-type');

    // Thêm dịch vụ
    Route::get('/list-service', 'AvnServiceController@listService')->middleware(['auth', 'permission'])->name('list-service');
    Route::get('/add-service', 'AvnServiceController@addService')->middleware(['auth', 'permission'])->name('add-service');
    Route::get('/edit-service/{id}', 'AvnServiceController@editService')->middleware(['auth', 'permission'])->name('edit-service');
    Route::post('/store-service', 'AvnServiceController@storeService')->middleware(['auth', 'permission'])->name('store-service');
    Route::put('/update-service/{id}', 'AvnServiceController@updateService')->middleware(['auth', 'permission'])->name('update-service');
    Route::delete('/delete-service/{id}', 'AvnServiceController@deleteService')->middleware(['auth', 'permission'])->name('delete-service');
});

// Trang dịch vụ
Route::get('/service-page', [AvnServiceController::class, 'servicePage'])->name('service-page');

<?php
use Modules\AvnUser\Http\Controllers\CustomerController;
use Modules\AvnUser\Http\Controllers\UserController;
use Modules\AvnUser\Http\Controllers\SocialController;

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

//-------------------------- Quản lý ---------------------//
Route::prefix('user')->group(function () {

    Route::post('/get-users', 'UserController@getUsers');

    // Chuyên gia
    Route::get('/list-partner', 'PartnerManagerController@listPartner')->middleware(['auth', 'permission'])->name('list-partner');
    Route::get('/add-partner', 'PartnerManagerController@addPartner')->middleware(['auth', 'permission'])->name('add-partner');
    Route::get('/edit-partner/{id}', 'PartnerManagerController@editPartner')->middleware(['auth', 'permission'])->name('edit-partner');
    Route::post('/store-partner', 'PartnerManagerController@storePartner')->middleware(['auth', 'permission'])->name('store-partner');
    Route::put('/update-partner/{id}', 'PartnerManagerController@updatePartner')->middleware(['auth', 'permission'])->name('update-partner');
    Route::delete('/delete-partner/{id}', 'PartnerManagerController@deletePartner')->middleware(['auth', 'permission'])->name('delete-partner');
    Route::post('/update-money-partner/{id}', 'PartnerManagerController@updateMoneyPartner')->middleware(['auth', 'permission'])->name('update-money-partner');

    // Khách
    Route::get('/list-customer', 'CustomerManagerController@listCustomer')->middleware(['auth', 'permission'])->name('list-customer');
    Route::get('/add-customer', 'CustomerManagerController@addCustomer')->middleware(['auth', 'permission'])->name('add-customer');
    Route::get('/edit-customer/{id}', 'CustomerManagerController@editCustomer')->middleware(['auth', 'permission'])->name('edit-customer');
    Route::post('/store-customer', 'CustomerManagerController@storeCustomer')->middleware(['auth', 'permission'])->name('store-customer');
    Route::put('/update-customer/{id}', 'CustomerManagerController@updateCustomer')->middleware(['auth', 'permission'])->name('update-customer');
    Route::delete('/delete-customer/{id}', 'CustomerManagerController@deleteCustomer')->middleware(['auth', 'permission'])->name('delete-customer');
    Route::post('/update-money-customer/{id}', 'CustomerManagerController@updateMoneyCustomer')->middleware(['auth', 'permission'])->name('update-money-customer');

    // Quản lý
    Route::get('/manager-profile', 'ManagerController@managerProfile')->middleware(['auth'])->name('manager-profile');
    Route::put('/update-manager-profile', 'ManagerController@updateManagerProfile')->middleware(['auth'])->name('update-manager-profile');
});

//-------------------------- Khách hàng tự đăng ký, xem thông tin bản thân,... ---------------------//

// Đăng ký, quên mật khẩu, đổi mật khẩu,....
Route::get('/customer-register', [CustomerController::class, 'customerRegister'])->name('customer-register');
Route::post('/store-register', [CustomerController::class, 'storeRegister'])->name('store-register');
Route::get('/forgot-password', [CustomerController::class, 'forgotPassword'])->name('forgot-password');

// Đăng nhập với fb, gg
Route::get('login/{social}', [SocialController::class, 'redirectToProvider'])->name('login-social');
Route::get('login/{social}/callback', [SocialController::class, 'handleProviderCallback'])->name('login-social-callback');

// Template reset password: resources\views\auth\reset-password.blade.php
// Route::get('/reset-password/{token}', [CustomerController::class, 'resetPassword'])->name('reset-password');

// Thông tin cá nhân
// Route::get('/my-profile', [CustomerController::class, 'myProfile'])->middleware(['auth'])->name('my-profile');
// Route::put('/update-customer-profile', [CustomerController::class, 'updateCustomerProfile'])->middleware(['auth'])->name('update-customer-profile');

//-------------------------- Chuyên gia xem thông tin bản thân,... ---------------------//
Route::get('/money-history', [UserController::class, 'moneyHistory'])->middleware(['auth'])->name('money-history');
Route::get('/profile', [UserController::class, 'profile'])->middleware(['auth'])->name('profile');
Route::put('/update-profile', [UserController::class, 'updateProfile'])->middleware(['auth'])->name('update-profile');
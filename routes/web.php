<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FileBackupController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [DashboardController::class, 'dashboard'])->name('home-page');

Route::get('/forbidden', function () {
    return view('forbidden');
})->name('forbidden');

// Dashboard
Route::get('/dashboard-manager', [DashboardController::class, 'dbManager'])->middleware(['auth', 'verified'])->name('dashboard-manager');

// setting
Route::get('/general-settings', [GeneralSettingsController::class, 'index'])->middleware(['auth', 'verified'])->name('general-settings');

Route::get('/general-settings-edit', [GeneralSettingsController::class, 'edit'])->middleware(['auth', 'verified', 'permission'])->name('general-settings-edit');

Route::put('/general-settings-update', [GeneralSettingsController::class, 'update'])->middleware(['auth', 'verified', 'permission'])->name('general-settings-update');

Route::put('/general-settings-update-image', [GeneralSettingsController::class, 'updateImage'])->middleware(['auth', 'verified', 'permission'])->name('general-settings-update-image');
// Notitify
Route::delete('/clear-notifications', [NotificationController::class, 'clearNotification'])->middleware(['auth', 'verified'])->name('clear-notifications');
Route::get('/read-notifications/{id}/{link?}', [NotificationController::class, 'readNotification'])->middleware(['auth', 'verified'])->name('read-notifications');
// user
Route::get('/add-user', [GeneralSettingsController::class, 'addUser'])->middleware(['auth', 'verified', 'permission'])->name('add-user');
Route::get('/list-user', [GeneralSettingsController::class, 'listUser'])->middleware(['auth', 'verified', 'permission'])->name('list-user');
Route::post('/store-user', [GeneralSettingsController::class, 'storeUser'])->middleware(['auth', 'verified', 'permission'])->name('store-user');
Route::get('/edit-user/{id}', [GeneralSettingsController::class, 'editUser'])->middleware(['auth', 'verified', 'permission'])->name('edit-user');
Route::post('/update-user/{id}', [GeneralSettingsController::class, 'updateUser'])->middleware(['auth', 'verified', 'permission'])->name('update-user');
Route::delete('/delete-user/{id}', [GeneralSettingsController::class, 'deleteUser'])->middleware(['auth', 'verified', 'permission'])->name('delete-user');

// switch module
Route::get('/list-module', [ModuleController::class, 'listModule'])->middleware(['auth', 'verified', 'permission'])->name('list-module');
Route::put('/switch-module', [ModuleController::class, 'switchModule'])->middleware(['auth', 'verified', 'permission'])->name('switch-module');
Route::get('/modules-settings-link', [ModuleController::class, 'modulesSettingsLink'])->middleware(['auth', 'verified', 'permission'])->name('modules-settings-link');
// File backup
Route::get('/list-backup', [FileBackupController::class, 'listBackup'])->middleware(['auth', 'verified', 'permission'])->name('list-backup');
Route::post('/confirm-backup', [FileBackupController::class, 'confirmBackup'])->middleware(['auth', 'verified'])->name('confirm-backup');

require __DIR__ . '/auth.php';
require __DIR__ . '/role.php';
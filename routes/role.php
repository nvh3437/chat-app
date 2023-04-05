<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::prefix('role')->group(function() {
    Route::get('/', [RoleController::class, 'list'])->name('role-list')->middleware(['auth', 'verified', 'permission']);
    Route::get('/edit-user/{id}', [RoleController::class, 'edit_user'])->name('role-edit-user')->middleware(['auth', 'verified', 'permission']);
    Route::get('/edit-permission/{id}', [RoleController::class, 'edit_permission'])->name('role-edit-permission')->middleware(['auth', 'verified', 'permission']);
    Route::put('/update-user/{id}', [RoleController::class, 'update_user'])->name('role-update-user')->middleware(['auth', 'verified', 'permission']);
    Route::put('/update-permission/{id}', [RoleController::class, 'update_permission'])->name('role-update-permission')->middleware(['auth', 'verified', 'permission']);
    Route::post('/store', [RoleController::class, 'store'])->name('role-store')->middleware(['auth', 'verified', 'permission']);
    Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('role-destroy')->middleware(['auth', 'verified', 'permission']);
});
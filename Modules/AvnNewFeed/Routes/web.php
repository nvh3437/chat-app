<?php
use Modules\AvnNewFeed\Http\Controllers\NewFeedController;
use Modules\AvnNewFeed\Http\Controllers\NewFeedCommentController;
use Modules\AvnNewFeed\Http\Controllers\NewFeedLikeController;
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

//---------------------------- New Feed -----------------------//
Route::get('/new-feed', [NewFeedController::class, 'newFeed'])->middleware(['auth'])->name('new-feed');
Route::get('/my-feed', [NewFeedController::class, 'myFeed'])->middleware(['auth'])->name('my-feed');
Route::get('/load-comment-feed', [NewFeedController::class, 'loadCommentFeed'])->middleware(['auth'])->name('load-comment-feed');
Route::get('/edit-feed/{alias}', [NewFeedController::class, 'editFeed'])->middleware(['auth'])->name('edit-feed');
Route::post('/store-feed', [NewFeedController::class, 'storeFeed'])->middleware(['auth'])->name('store-feed');
Route::put('/update-feed/{id}', [NewFeedController::class, 'updateFeed'])->middleware(['auth'])->name('update-feed');
Route::delete('/delete-feed/{id}', [NewFeedController::class, 'deleteFeed'])->middleware(['auth'])->name('delete-feed');

//---------------------------- Comment -----------------------//
Route::post('/store-comment-feed', [NewFeedCommentController::class, 'storeCommentFeed'])->middleware(['auth'])->name('store-comment-feed');
Route::put('/update-comment-feed/{id}', [NewFeedCommentController::class, 'updateCommentFeed'])->middleware(['auth'])->name('update-comment-feed');
Route::delete('/delete-comment-feed/{id}', [NewFeedCommentController::class, 'deleteCommentFeed'])->middleware(['auth'])->name('delete-comment-feed');

//---------------------------- Like -----------------------//
Route::post('/store-like-feed', [NewFeedLikeController::class, 'storeLikeFeed'])->middleware(['auth'])->name('store-like-feed');
Route::post('/delete-like-feed', [NewFeedLikeController::class, 'deleteLikeFeed'])->middleware(['auth'])->name('delete-like-feed');
<?php
use Modules\AvnPost\Http\Controllers\PostController;
use Modules\AvnPost\Http\Controllers\PostCommentController;
use Modules\AvnPost\Http\Controllers\PostLikeController;
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
// ------------------------ Quản lý ----------------------//
Route::prefix('post')->group(function() {

    // Loại danh mục
    Route::get('/list-category', 'PostCatgoryController@listCategory')->middleware(['auth', 'permission'])->name('list-category');
    Route::post('/store-category', 'PostCatgoryController@storeCategory')->middleware(['auth', 'permission'])->name('store-category');
    Route::put('/update-category/{id}', 'PostCatgoryController@updateCategory')->middleware(['auth', 'permission'])->name('update-category');
    Route::delete('/delete-category/{id}', 'PostCatgoryController@deleteCategory')->middleware(['auth', 'permission'])->name('delete-category');

    // Bài viết
    Route::get('/list-post', 'PostController@listPost')->middleware(['auth', 'permission'])->name('list-post');
    Route::get('/add-post', 'PostController@addPost')->middleware(['auth', 'permission'])->name('add-post');
    Route::get('/edit-post/{id}', 'PostController@editPost')->middleware(['auth', 'permission'])->name('edit-post');
    Route::post('/store-post', 'PostController@storePost')->middleware(['auth', 'permission'])->name('store-post');
    Route::put('/update-post/{id}', 'PostController@updatePost')->middleware(['auth', 'permission'])->name('update-post');
    Route::delete('/delete-post/{id}', 'PostController@deletePost')->middleware(['auth', 'permission'])->name('delete-post');

});

// ------------------------ Trang chủ ----------------------//
Route::get('/post-page', [PostController::class, 'postPage'])->name('post-page');
Route::get('/post-of-category/{alias}', [PostController::class, 'postOfCategory'])->name('post-of-category');
Route::get('/view-post/{alias}', [PostController::class, 'viewPost'])->name('view-post');

// ------------------------ Bình luận ----------------------//
Route::post('/store-post-comment', [PostCommentController::class, 'storePostComment'])->middleware(['auth'])->name('store-post-comment');
Route::put('/update-post-comment/{id}', [PostCommentController::class, 'updatePostComment'])->middleware(['auth'])->name('update-post-comment');
Route::delete('/delete-post-comment/{id}', [PostCommentController::class, 'deletePostComment'])->middleware(['auth'])->name('delete-post-comment');

// ------------------------ Like ----------------------//
Route::post('/store-post-like', [PostLikeController::class, 'storePostLike'])->middleware(['auth'])->name('store-post-like');
Route::delete('/delete-post-like/{id}', [PostLikeController::class, 'deletePostLike'])->middleware(['auth'])->name('delete-post-like');
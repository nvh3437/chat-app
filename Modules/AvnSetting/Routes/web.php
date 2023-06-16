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

Route::prefix('setting')->group(function () {

    //-------------------------------------------- Navbar -------------------------------------//
    Route::get('/navbar', 'NavbarController@navbar')->middleware(['auth', 'permission'])->name('navbar');
    Route::get('/edit-navbar/{id}', 'NavbarController@editNavbar')->middleware(['auth', 'permission'])->name('edit-navbar');
    Route::post('/store-navbar', 'NavbarController@storeNavbar')->middleware(['auth', 'permission'])->name('store-navbar');
    Route::put('/update-navbar/{id}', 'NavbarController@updateNavbar')->middleware(['auth', 'permission'])->name('update-navbar');
    Route::delete('/delete-navbar/{id}', 'NavbarController@deleteNavbar')->middleware(['auth', 'permission'])->name('delete-navbar');

    //------------------------------------------ Footer ----------------------------------------//
    Route::get('/footer', 'FooterController@footer')->middleware(['auth', 'permission'])->name('footer');
    Route::put('/update-footer-des', 'FooterController@updateFooterDes')->middleware(['auth', 'permission'])->name('update-footer-des');

    // Thông tin cơ bản
    Route::post('/store-footer', 'FooterController@storeFooter')->middleware(['auth', 'permission'])->name('store-footer');
    Route::put('/update-footer/{id}', 'FooterController@updateFooter')->middleware(['auth', 'permission'])->name('update-footer');
    Route::delete('/delete-footer/{id}', 'FooterController@deleteFooter')->middleware(['auth', 'permission'])->name('delete-footer');

    //------------------------------------------- Seo các trang -------------------------------//

    // Trang chủ
    Route::get('/home-seo', 'PageController@homeSeo')->middleware(['auth', 'permission'])->name('home-seo');
    Route::put('/update-home-seo', 'PageController@updateHomeSeo')->middleware(['auth', 'permission'])->name('update-home-seo');

    // Liên hệ
    Route::get('/contact-seo', 'PageController@contactSeo')->middleware(['auth', 'permission'])->name('contact-seo');
    Route::put('/update-contact-seo', 'PageController@updateContactSeo')->middleware(['auth', 'permission'])->name('update-contact-seo');

    // Bài viết
    Route::get('/post-seo', 'PageController@postSeo')->middleware(['auth', 'permission'])->name('post-seo');
    Route::put('/update-post-seo', 'PageController@updatePostSeo')->middleware(['auth', 'permission'])->name('update-post-seo');

    Route::get('/order-chat-seo', 'PageController@orderChatSeo')->middleware(['auth', 'permission'])->name('order-chat-seo');
    Route::put('/update-order-chat-seo', 'PageController@updateOrderChatSeo')->middleware(['auth', 'permission'])->name('update-order-chat-seo');
});
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
/**
 * TOPページ
 */
Route::get('/', function () { return view('top'); })->name('top');

/**
 * 認証
 */
Auth::routes(['register' => true, 'reset' => true, 'verify' => false, 'confirm' => false]);

/**
 * ログイン後
 */
Route::middleware('auth')->group(function () {
    // 記事
    Route::resource('art', 'ArticleController');
    // カテゴリ
    Route::resource('category', 'CategoryController')->only(['create', 'store', 'destroy']);
    // マイページ
    Route::prefix('mypage')->name('mypage.')->group(function(){
        Route::get('/profile', 'UserController@showProfileEditForm')->name('profile');
        Route::put('/profile', 'UserController@profileUpdate')->name('profile.update');
        // Route::get('/password', 'UserController@showPasswordChangeForm')->name('password');
        // Route::put('/password', 'UserController@passwordUpdate')->name('password.update');
        Route::get('/unsubscribe', 'UserController@showUnsubscribeForm')->name('unsubscribe');
        Route::delete('/unsubscribe', 'UserController@unsubscribe')->name('unsubscribe');
    });
});

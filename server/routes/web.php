<?php

use Illuminate\Support\Facades\Route;

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

// メイン画面
Route::get('/', 'CountriesController@index')->name('main');

//国詳細ページ移動
Route::get('/detail/{id}', 'CountriesController@detail')->name('detail');


Route::group(['middleware' => ['auth']], function () {
    //レビュー送信
    Route::post('/detail/create/review', 'ReviewController@createReview');

    //マイページ遷移
    Route::get('/mypage', 'MypageController@index')->name('mypage');
    //プロフィール追加
    Route::post('/mypage/create/profile', 'MypageController@create');
    //レビュー削除
    Route::post('review/delete', 'ReviewController@delete')->name('review.delete');
});


Auth::routes();

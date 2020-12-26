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

//検索結果表示
Route::get('/serch', 'CountriesController@serch')->name('serch');

//ランキング
Route::get('/ranking', 'CountriesController@ranking')->name('ranking');

//ユーザー一覧
Route::get('/user', 'UserController@list')->name('user.list');

//ユーザーページ一覧
Route::get('/user/{id}', 'UserController@user')->name('user');


Route::group(['middleware' => ['auth']], function () {
    //レビュー送信
    Route::post('/detail/create/review', 'ReviewController@createReview');

    //レビュー削除
    Route::post('/review/delete', 'ReviewController@delete')->name('review.delete');

    //プロフィール追加
    Route::post('/mypage/create/profile', 'UserController@create');
});


Auth::routes();

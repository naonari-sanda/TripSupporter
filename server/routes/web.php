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
Route::get('/', 'CountryController@index')->name('main');

//国詳細ページ移動
Route::get('/detail/{id}', 'CountryController@detail')->name('detail');

//検索結果表示
Route::get('/serch', 'CountryController@serch')->name('serch');

//ランキング
Route::get('/ranking', 'CountryController@ranking')->name('ranking');


Route::group(['middleware' => ['auth']], function () {

    //ユーザー一覧
    Route::get('/user', 'UserController@list')->name('user.list');

    //ユーザーページ一覧
    Route::get('/user/{id}', 'UserController@user')->name('user');

    //レビュー送信
    Route::post('/detail/create/review', 'ReviewController@createReview');

    //レビュー削除
    Route::post('/review/delete', 'ReviewController@delete')->name('delete.review');

    // //プロフィール追加
    Route::post('/user/create/profile', 'UserController@create')->name('create.acount');

    //画像アップロード
    Route::post('/upload/img', 'ReviewController@upload')->name('create.img');
    //画像削除
    Route::post('/delete/img', 'ReviewController@deleteImg')->name('delete.img');
});


Auth::routes();

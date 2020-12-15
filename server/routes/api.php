<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//お気に入り追加
Route::post('/{id}/like', 'LikesController@like');
Route::post('/{id}/unlike', 'LikesController@unlike');
//アカウント情報追加
Route::post('/mypage/create/profile', 'MypageController@create');

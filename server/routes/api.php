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

//ランキング
Route::get('/area', 'CountryController@area');
Route::get('/population', 'CountryController@population');
Route::get('/gdp', 'CountryController@gdp');
Route::get('/happiness', 'CountryController@happiness');

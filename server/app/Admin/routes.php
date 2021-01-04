<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('/users', UserController::class);
    $router->resource('/acounts', AcountController::class);
    $router->resource('/countries', CountryControler::class);
    $router->resource('/reviews', ReviewController::class);
    $router->resource('/likes', LikeController::class);
    $router->resource('/images', ImageController::class);
    $router->resource('/information', InformationController::class);
});

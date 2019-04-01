<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/category', 'CategoryController');
    $router->resource('/fundCategory', 'FundCategoryController');
    $router->resource('/fundManager', 'FundManagerController');
    $router->resource('/fund', 'FundController');
    $router->resource('/fundNotice', 'FundNoticeController');
    $router->resource('/fundGroup', 'FundGroupController');
    $router->resource('/news', 'NewsController');
    $router->resource('/bank', 'BankController');
});

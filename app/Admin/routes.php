<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->resource('/', 'FundNoticeController');
    $router->resource('/category', 'CategoryController');
    $router->resource('/fundCategory', 'FundCategoryController');
    $router->resource('/fundManager', 'FundManagerController');
    $router->resource('/fund', 'FundController');
    $router->resource('/fundNotice', 'FundNoticeController');
    $router->resource('/fundGroup', 'FundGroupController');
    $router->resource('/news', 'NewsController');
    $router->resource('/bank', 'BankController');
    $router->resource('/hotWords', 'HotWordsController');
    $router->resource('/jobs', 'JobsController');
});

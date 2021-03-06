<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    
    $router->get('users', 'UsersController@index');
    $router->put('users/{id}', 'UsersController@update');

    
    $router->get('products', 'ProductsController@index');
    $router->get('products/create', 'ProductsController@create');
    $router->post('products', 'ProductsController@store');
    $router->get('products/{id}/edit', 'ProductsController@edit');
    $router->put('products/{id}', 'ProductsController@update');
    $router->delete('products/{id}', 'ProductsController@destroy');

    $router->get('orders', 'OrdersController@index')->name('admin.orders.index');
    $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show');

    
    $router->resource('charities', 'CharitiesController');
    
    $router->resource('tags', 'TagsController');

    $router->resource('topic_categories', 'TopicCategoriesController');
    $router->resource('topics', 'TopicsController');

    $router->resource('video_categories', 'VideoCategoriesController');
    $router->resource('videos', 'VideosController');

    
});
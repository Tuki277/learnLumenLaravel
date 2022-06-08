<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\LearnRawQuery;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'UserController@Register');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/posts', 'PostController@getAllPost');
        $router->post('/posts', 'PostController@postPosts');
        $router->get('/posts/{id}', 'PostController@getById');
        $router->put('/posts/{id}', 'PostController@updatePosts');
        $router->delete('/posts/{id}', 'PostController@deletePosts');

        $router->get('/category', 'CategoryController@getAllCategory');
        $router->post('/category', 'CategoryController@postCategory');
        $router->put('/category/{id}', 'CategoryController@updateCategory');
        $router->get('/category/{id}', 'CategoryController@getById');
        $router->delete('/category/{id}', 'CategoryController@deleteCategory');

        $router->get('/news', 'NewsController@getAllNews');
        $router->post('/news', 'NewsController@postNews');
        $router->get('/news/{id}', 'NewsController@getById');
        $router->put('/news/{id}', 'NewsController@updatePosts');
        $router->delete('/news/{id}', 'NewsController@deletePosts');
    });

    $router->group(['prefix' => 'learn'], function () use ($router) {
        $router->get('/rawquery', 'LearnRawQuery@getAll');
        $router->post('/rawquery', 'LearnRawQuery@add');
        $router->put('/rawquery/{id}', 'LearnRawQuery@update');
        $router->get('/rawquery/{id}', 'LearnRawQuery@getById');
        $router->delete('/rawquery/{id}', 'LearnRawQuery@delete');
    });

});

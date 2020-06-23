<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

/** public route */
$router->group(['prefix' => '/api/v1'], function () use ($router) {
    $router->group(['prefix' => '/auth'], function () use ($router) {
        $router->post('/login', 'AuthController@login');
        $router->post('/logout', 'AuthController@logout');
        $router->post('/refresh', 'AuthController@refresh');
        $router->get('/me', 'AuthController@me');
    });
});

/** protected route */
$router->group(['prefix' => '/api/v1', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => '/user'], function () use ($router) {
        $router->post('', 'UserController@add');
        $router->get('', 'UserController@getList');
        $router->group(['prefix' => '/{id}'], function () use ($router) {
            $router->put('', 'UserController@edit');
            $router->get('', 'UserController@get');
            $router->delete('', 'UserController@delete');
        });
    });
});

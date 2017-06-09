<?php

$api = app(Dingo\Api\Routing\Router::class);

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'v1', 'namespace' => 'App\Api\Controllers'], function ($api) {


        $api->post('login', ['middleware' => 'api.throttle', 'limit' => 10, 'expires' => 2, 'uses' => 'LoginController@login']);

        $api->post('/token/refresh', 'AuthController@refreshToken');

        $api->group(['middleware' => 'jwt.auth'], function($api) {
            $api->post('logout', 'LoginController@logout');
            $api->get('/me', 'MeController@me');

            $api->get('/users', ['name' => 'user.index', 'users' => 'UsersController@index']);
            $api->get('/users/search', ['name' => 'user.search', 'users' => 'UsersController@search']);
        });
    });
});
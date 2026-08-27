<?php

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

$router->get(
    '/',
    'HomeController@index'
);


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

$router->get(
    '/admin/login',
    'AuthController@adminLogin'
);

$router->post(
    '/admin/login',
    'AuthController@authenticateAdmin'
);

$router->get(
    '/client/login',
    'AuthController@clientLogin'
);

$router->post(
    '/client/login',
    'AuthController@authenticateClient'
);

$router->get(
    '/client/register',
    'AuthController@register'
);

$router->post(
    '/client/register',
    'AuthController@storeRegistration'
);

$router->get(
    '/logout',
    'AuthController@logout'
);


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

$router->get(
    '/admin/dashboard',
    'AdminController@dashboard',
    [AdminMiddleware::class]
);


/*
|--------------------------------------------------------------------------
| Client
|--------------------------------------------------------------------------
*/

$router->get(
    '/client/dashboard',
    'ClientController@dashboard',
    [ClientMiddleware::class]
);
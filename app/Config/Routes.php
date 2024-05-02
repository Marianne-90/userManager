<?php

use App\Controllers\User;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$user = new User;

$routes->get('/', 'Home::index');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

if ($user->validator()) {
    $routes->resource('usuarios', ['placeholder' => '(:num)', 'controller' => 'Usuarios', 'except' => 'show']);

$routes->get('/image/new/(:num)', 'Images::new/$1');
$routes->post('/image/(:num)', 'Images::create/$1');
$routes->get('/image/(:num)', 'Images::index/$1');
$routes->get('/image/(:num)/(:num)', 'Images::show/$1/$2');
$routes->get('/image/edit/(:num)/(:num)', 'Images::edit/$1/$2');
$routes->put('/image/(:num)/(:num)', 'Images::update/$1/$2');
$routes->delete('/image/(:num)/(:num)', 'Images::delete/$1/$2');


}

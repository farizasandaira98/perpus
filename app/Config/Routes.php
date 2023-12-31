<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/buku', 'BukuController::index');
$routes->get('/buku/create' , 'BukuController::create');
$routes->post('/buku/post' , 'BukuController::post');
$routes->get('/buku/edit/(:num)', 'BukuController::edit/$1');
$routes->post('/buku/update/(:num)', 'BukuController::update/$1');
$routes->get('/buku/delete/(:num)', 'BukuController::delete/$1');

$routes->get('/user', 'UserController::index');
$routes->get('/user/create' , 'UserController::create');
$routes->post('/user/post' , 'UserController::store');
$routes->get('/user/edit/(:num)', 'UserController::edit/$1');
$routes->post('/user/update/(:num)', 'UserController::update/$1');
$routes->get('/user/delete/(:num)', 'UserController::delete/$1');
$routes->get('/login', 'UserController::auth');
$routes->post('/auth/login', 'UserController::login');
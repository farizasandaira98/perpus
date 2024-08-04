<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//dashboard
$routes->get('/', 'Home::index');

//buku routes
$routes->get('/', 'Home::index');
$routes->get('/buku', 'BukuController::index');
$routes->get('/buku/create' , 'BukuController::create');
$routes->post('/buku/post' , 'BukuController::post');
$routes->post('/buku/search' , 'BukuController::search');
$routes->get('/buku/edit/(:num)', 'BukuController::edit/$1');
$routes->post('/buku/update/(:num)', 'BukuController::update/$1');
$routes->get('/buku/delete/(:num)', 'BukuController::delete/$1');

//user routes
$routes->get('/user', 'UserController::index');
$routes->get('/user/create' , 'UserController::create');
$routes->post('/user/post' , 'UserController::store');
$routes->get('/user/edit/(:num)', 'UserController::edit/$1');
$routes->post('/user/update/(:num)', 'UserController::update/$1');
$routes->get('/user/delete/(:num)', 'UserController::delete/$1');
$routes->post('/user/search' , 'UserController::search');

//klasifikasi routes
$routes->get('/klasifikasi', 'KlasifikasiController::index');
$routes->get('/klasifikasi/create' , 'KlasifikasiController::create');
$routes->post('/klasifikasi/post' , 'KlasifikasiController::post');
$routes->get('/klasifikasi/edit/(:num)', 'KlasifikasiController::edit/$1');
$routes->post('/klasifikasi/update/(:num)', 'KlasifikasiController::update/$1');
$routes->get('/klasifikasi/delete/(:num)', 'KlasifikasiController::delete/$1');

//profile routes
$routes->get('/profile', 'Home::profile');

//authentication
$routes->get('/login', 'UserController::auth');
$routes->post('/auth/login', 'UserController::login');
$routes->get('/logout', 'UserController::logout');

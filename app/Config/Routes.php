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
$routes->delete('/buku/delete/(:num)', 'BukuController::delete/$1');
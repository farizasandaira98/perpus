<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/buku', 'BukuController::index');
$routes->get('/buku/create' , 'BukuController::create');
$routes->post('/buku/post' , 'BukuController::post');
$routes::get('/buku/edit/(:id)', 'BukuController::edit');
$routes::post('/buku/update/(:id)', 'BukuController::update');
$routes::delete('/buku/delete/(:id)', 'BukuController::delete');
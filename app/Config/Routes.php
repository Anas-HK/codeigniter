<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Route when id is given. num is predefined which means it looks for a numeric value and $1 is the placeholder for num
$routes->get('/(:num)', 'Home::index/$1');
$routes->delete('/delete/(:num)', 'Home::delete/$1');
$routes->post('/status/(:num)/(:any)', 'Home::status/$1/$2');
$routes->post('/update/(:num)', 'Home::update/$1');
$routes->post('/create', 'Home::create');
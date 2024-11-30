<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/project1', 'Project1::index');

$routes->post('/project2', 'Project2::index');

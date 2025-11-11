<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Users::index');

$routes->get('/login', 'Users::login');

$routes->get('/signup', 'Users::signup');

$routes->get('/roadMap', 'Users::roadMap');

$routes->get('/moodBoard', 'Users::moodBoard');

$routes->get('/dashboard', 'Admin::dashboard');

$routes->get('/users', 'Admin::users');
$routes->get('/users_create', 'Admin::users_create');
$routes->get('/users_update', 'Admin::users_update');

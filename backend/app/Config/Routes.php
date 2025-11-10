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

// Show login page
$routes->get('login', 'Auth::showLoginPage');

// Process login
$routes->post('login', 'Auth::login');

// Logout
$routes->get('logout', 'Auth::logout');

// ============================================
// User Management Routes (CRUD Testing)
// Protected - Admin Only
// ============================================

// READ - Display all users
$routes->get('test/users', 'CRUDUsers::showUsersPage', ['filter' => 'auth:admin']);

// CREATE - Show create form
$routes->get('test/users/create', 'CRUDUsers::showCreateUserPage', ['filter' => 'auth:admin']);

// CREATE - Process user creation
$routes->post('test/users/create', 'CRUDUsers::createUser', ['filter' => 'auth:admin']);

// UPDATE - Show update form
$routes->get('test/users/update/(:num)', 'CRUDUsers::showUpdateUserPage/$1', ['filter' => 'auth:admin']);

// UPDATE - Process user update
$routes->post('test/users/update', 'CRUDUsers::updateUser', ['filter' => 'auth:admin']);

// DELETE - Soft delete user
$routes->post('test/users/delete', 'CRUDUsers::deleteUser', ['filter' => 'auth:admin']);

// ============================================
// Product Management Routes (CRUD Testing)
// Protected - Admin Only
// ============================================

// READ - Display all products
$routes->get('test/products', 'CRUDUsers::showProductsPage', ['filter' => 'auth:admin']);

// CREATE - Show create form
$routes->get('test/products/create', 'CRUDUsers::showCreateProductPage', ['filter' => 'auth:admin']);

// CREATE - Process product creation
$routes->post('test/products/create', 'CRUDUsers::createProduct', ['filter' => 'auth:admin']);

// UPDATE - Show update form
$routes->get('test/products/update/(:num)', 'CRUDUsers::showUpdateProductPage/$1', ['filter' => 'auth:admin']);

// UPDATE - Process product update
$routes->post('test/products/update', 'CRUDUsers::updateProduct', ['filter' => 'auth:admin']);

// DELETE - Soft delete product
$routes->post('test/products/delete', 'CRUDUsers::deleteProduct', ['filter' => 'auth:admin']);

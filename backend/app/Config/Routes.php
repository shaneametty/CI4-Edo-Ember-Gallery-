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

// ============================================
// Authentication Routes
// ============================================

// Show login page
$routes->get('login', 'Auth::showLoginPage');

// Process login
$routes->post('login', 'Auth::login');

// Show signup page
$routes->get('signup', 'Auth::showSignupPage');

// Process signup
$routes->post('signup', 'Auth::signup');

// Logout
$routes->get('logout', 'Auth::logout');

// ============================================
// User Management Routes (CRUD Testing)
// Protected - Admin Only
// ============================================

// READ - Display all users
$routes->get('admin/users', 'CRUDUsers::showUsersPage', ['filter' => 'auth:admin']);

// CREATE - Show create form
$routes->get('admin/users/create', 'CRUDUsers::showCreateUserPage', ['filter' => 'auth:admin']);

// CREATE - Process user creation
$routes->post('admin/users/create', 'CRUDUsers::createUser', ['filter' => 'auth:admin']);

// UPDATE - Show update form
$routes->get('admin/users/update/(:num)', 'CRUDUsers::showUpdateUserPage/$1', ['filter' => 'auth:admin']);

// UPDATE - Process user update
$routes->post('admin/users/update', 'CRUDUsers::updateUser', ['filter' => 'auth:admin']);

// DELETE - Soft delete user
$routes->post('admin/users/delete', 'CRUDUsers::deleteUser', ['filter' => 'auth:admin']);

// ============================================
// Product Management Routes (CRUD Testing)
// Protected - Admin Only
// ============================================

// READ - Display all products
$routes->get('admin/products', 'CRUDUsers::showProductsPage', ['filter' => 'auth:admin']);

// CREATE - Show create form
$routes->get('admin/products/create', 'CRUDUsers::showCreateProductPage', ['filter' => 'auth:admin']);

// CREATE - Process product creation
$routes->post('admin/products/create', 'CRUDUsers::createProduct', ['filter' => 'auth:admin']);

// UPDATE - Show update form
$routes->get('admin/products/update/(:num)', 'CRUDUsers::showUpdateProductPage/$1', ['filter' => 'auth:admin']);

// UPDATE - Process product update
$routes->post('admin/products/update', 'CRUDUsers::updateProduct', ['filter' => 'auth:admin']);

// DELETE - Soft delete product
$routes->post('admin/products/delete', 'CRUDUsers::deleteProduct', ['filter' => 'auth:admin']);

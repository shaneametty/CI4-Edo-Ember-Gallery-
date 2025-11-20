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
// ADMIN - DASHBOARD
// Protected - Admin Only
// ============================================
$routes->get('admin/dashboard', 'Admin::dashboard', ['filter' => 'auth:admin']);
$routes->get('admin', 'Admin::dashboard', ['filter' => 'auth:admin']); // Alias: /admin redirects to dashboard

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

$routes->group('admin/users', ['filter' => 'auth:admin'], function ($routes) {
    // READ - Display all users
    $routes->get('/', 'AdminUsers::showUsersPage');

    // CREATE - Show create form
    $routes->get('create', 'AdminUsers::showCreateUserPage');

    // CREATE - Process user creation
    $routes->post('create', 'AdminUsers::createUser');

    // UPDATE - Show update form
    $routes->get('update/(:num)', 'AdminUsers::showUpdateUserPage/$1');

    // UPDATE - Process user update
    $routes->post('update', 'AdminUsers::updateUser');

    // DELETE - Soft delete user
    $routes->post('delete', 'AdminUsers::deleteUser');
});

// ============================================
// Product Management Routes (CRUD Testing)
// Protected - Admin Only
// ============================================

$routes->group('admin/products', ['filter' => 'auth:admin'], function ($routes) {
    // READ - Display all products
    $routes->get('/', 'AdminProducts::showProductsPage');

    // CREATE - Show create form
    $routes->get('create', 'AdminProducts::showCreateProductPage');

    // CREATE - Process product creation
    $routes->post('create', 'AdminProducts::createProduct');

    // UPDATE - Show update form
    $routes->get('update/(:num)', 'AdminProducts::showUpdateProductPage/$1');

    // UPDATE - Process product update
    $routes->post('update', 'AdminProducts::updateProduct');

    // DELETE - Soft delete product
    $routes->post('delete', 'AdminProducts::deleteProduct');
});

// ============================================
// ADMIN - ORDERS MANAGEMENT
// Protected - Admin Only
// ============================================
$routes->group('admin/orders', ['filter' => 'auth:admin'], function ($routes) {

    // List & Create
    $routes->get('/', 'AdminOrders::index');
    $routes->get('create', 'AdminOrders::create');
    $routes->post('create', 'AdminOrders::store');

    // View & Update
    $routes->get('show/(:num)', 'AdminOrders::show/$1');
    $routes->get('update/(:num)', 'AdminOrders::edit/$1'); // if you have edit()
    $routes->post('update-status', 'AdminOrders::updateStatus');
    $routes->post('update-payment', 'AdminOrders::updatePayment');

    // Delete
    $routes->post('delete', 'AdminOrders::delete');
});

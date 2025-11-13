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
// Orders Management Routes (CRUD)
// Protected - Admin Only
// ============================================

$routes->group('', ['filter' => 'auth:admin'], static function ($routes) {
    // READ - Display all orders
    $routes->get('admin/orders', 'CRUDOrders::showOrdersPage');
    // CREATE - Show create form
    $routes->get('orders_create', 'CRUDOrders::showCreateOrderPage');
    // CREATE - Process order creation
    $routes->post('orders_create', 'CRUDOrders::createOrder');
    // UPDATE - Show update form
    $routes->get('orders_update/(:num)', 'CRUDOrders::showUpdateOrderPage/$1');
    // UPDATE - Process order update
    $routes->post('orders_update', 'CRUDOrders::updateOrder');
    // DELETE - Soft delete order
    $routes->post('orders_delete', 'CRUDOrders::deleteOrder');
});

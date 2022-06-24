<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/', ['filter' => 'role:SUPER ADMIN, KASIR, ATASAN, GUDANG, MARKETING, PURCHASING'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('home-page', 'Home::index');
    $routes->get('profile-setting', 'Home::profile');
    $routes->patch('profile-setting', 'Home::profile');
});

$routes->group('categories', ['filter' => 'role:SUPER ADMIN, GUDANG, PURCHASING'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Category::index');
    $routes->patch('/', 'Category::index');
    $routes->delete('/', 'Category::index');
    $routes->post('/', 'Category::index');
});

$routes->group('items', ['filter' => 'role:SUPER ADMIN, GUDANG, PURCHASING'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Item::index');
    $routes->get('getItemAll', 'Item::ajaxDatatables');
    $routes->post('/', 'Item::index');
    $routes->patch('/', 'Item::index');
    $routes->delete('/', 'Item::index');
});

$routes->group('item-reports', ['filter' => 'role:SUPER ADMIN, GUDANG, PURCHASING'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Item::report');
    $routes->post('/', 'Item::report');
});

$routes->group('members', ['filter' => 'role:SUPER ADMIN, KASIR, MARKETING'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Member::index');
    $routes->post('/', 'Member::index');
    $routes->patch('/', 'Member::index');
    $routes->delete('/', 'Member::index');
});

$routes->group('users', ['filter' => 'role:SUPER ADMIN'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'User::index');
    $routes->post('/', 'User::index');
    $routes->patch('/', 'User::index');
    $routes->delete('/', 'User::index');
});

$routes->group('suppliers', ['filter' => 'role:SUPER ADMIN, GUDANG, PURCHASING'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Supplier::index');
    $routes->post('/', 'Supplier::index');
    $routes->patch('/', 'Supplier::index');
    $routes->delete('/', 'Supplier::index');
    $routes->get('view-orders/', 'Supplier::view_order');
    $routes->patch('view-orders', 'Supplier::view_order');
    $routes->get('order-items', 'Supplier::order');
    $routes->post('order-items', 'Supplier::order');
    $routes->patch('order-items', 'Supplier::order');
    $routes->delete('order-items', 'Supplier::order');
    $routes->get('create_orders', 'Supplier::create_order');
    $routes->post('create_orders', 'Supplier::create_order');
    $routes->patch('create_orders', 'Supplier::create_order');
    $routes->delete('create_orders', 'Supplier::create_order');
    $routes->post('invoice', 'Supplier::export_pdf');
});

$routes->group('marketing', ['filter' => 'role:SUPER ADMIN, MARKETING'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Marketing::index');
    $routes->get('order-items/getItemAll', 'Marketing::ajaxDatatables');
    $routes->get('view-orders', 'Marketing::view_order');
    $routes->get('order-items', 'Marketing::order');
    $routes->get('list-orders', 'Marketing::list_orders');
    $routes->post('order-items', 'Marketing::order');
    $routes->patch('order-items', 'Marketing::order');
    $routes->delete('order-items', 'Marketing::order');
});

$routes->group('transaction', ['filter' => 'role:SUPER ADMIN, KASIR'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Transaction::index');
    $routes->post('/', 'Transaction::index');
    $routes->delete('/', 'Transaction::index');
    $routes->patch('validation_payment', 'Transaction::validation_payment');
    $routes->post('report/add_handling', 'Transaction::add_handling_report');
    $routes->post('add_handling', 'Transaction::add_handling');
    $routes->get('report', 'Transaction::report');
    $routes->post('report', 'Transaction::report');
    $routes->delete('report', 'Transaction::report');
    $routes->post('report/search', 'Transaction::search');
    $routes->delete('report/search', 'Transaction::search');
    $routes->get('report/search', 'Transaction::search');
    $routes->get('pengaturan', 'Transaction::pengaturan');
    $routes->patch('pengaturan', 'Transaction::pengaturan');
});

$routes->group('transaction-general', ['filter' => 'role:SUPER ADMIN, KASIR'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'GeneralTransaction::index');
    $routes->post('/', 'GeneralTransaction::index');
    $routes->delete('/', 'GeneralTransaction::index');
    $routes->patch('validation_payment', 'GeneralTransaction::validation_payment');
    $routes->post('report/add_handling', 'GeneralTransaction::add_handling_report');
    $routes->post('add_handling', 'GeneralTransaction::add_handling');
    $routes->get('report', 'GeneralTransaction::report');
    $routes->post('report', 'GeneralTransaction::report');
    $routes->delete('report', 'GeneralTransaction::report');
    $routes->post('report/search', 'GeneralTransaction::search');
    $routes->delete('report/search', 'GeneralTransaction::search');
    $routes->get('report/search', 'GeneralTransaction::search');
});

$routes->group('report', ['filter' => 'role:SUPER ADMIN, ATASAN'], ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Report::index');
    $routes->post('/', 'Report::index');
});

$routes->group('', ['namespace' => 'App\Controllers'], static function ($routes) {
    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

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
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Home::index');
	$routes->get('/home-page', 'Home::index');
});

$routes->group('categories', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Category::index');
	$routes->patch('/', 'Category::index');
	$routes->delete('/', 'Category::index');
	$routes->post('/', 'Category::index');
});

$routes->group('items', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Item::index');
	$routes->post('/', 'Item::index');
	$routes->patch('/', 'Item::index');
	$routes->delete('/', 'Item::index');
});

$routes->group('members', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Member::index');
});

$routes->group('users', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'User::index');
});

$routes->group('suppliers', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Supplier::index');
	$routes->post('/', 'Supplier::index');
	$routes->patch('/', 'Supplier::index');
	$routes->delete('/', 'Supplier::index');
	$routes->get('order-items', 'Supplier::order');
	$routes->get('report-order', 'Supplier::report');
});

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
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
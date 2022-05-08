<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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
$routes->get('/', 'Home::index');

//http://localhost/codeigniter/codeigniter4/public/api/clientes/api

$routes->group('api', ['namespace' => 'App\Controllers\API'], function($routes) {
    //http://localhost/codeigniter/codeigniter4/public/api/clientes/api/clientes --> GET
    $routes->get('clientes', 'Clientes::index');
    $routes->post('clientes/create', 'Clientes::create');
    $routes->get('clientes/edit/(:num)', 'Clientes::edit/$1');
    $routes->put('clientes/update/(:num)', 'Clientes::update/$1');
    $routes->delete('clientes/delete/(:num)', 'Clientes::delete/$1');

    $routes->get('cuentas', 'Cuentas::index');
    $routes->post('cuentas/create', 'Cuentas::create');
    $routes->get('cuentas/edit/(:num)', 'Cuentas::edit/$1');
    $routes->put('cuentas/update/(:num)', 'Cuentas::update/$1');
    $routes->delete('cuentas/delete/(:num)', 'Cuentas::delete/$1');

    $routes->get('transaccions', 'Transaccions::index');
    $routes->post('transaccions/create', 'Transaccions::create');
    $routes->get('transaccions/edit/(:num)', 'Transaccions::edit/$1');
    $routes->put('transaccions/update/(:num)', 'Transaccions::update/$1');
    $routes->delete('transaccions/delete/(:num)', 'Transaccions::delete/$1');
    $routes->get('transaccions/cliente/(:num)', 'Transaccions::getTransaccionesByCliente/$1');

    $routes->get('tipotransaccions', 'TipoTransaccions::index');
    $routes->post('tipotransaccions/create', 'TipoTransaccions::create');
    $routes->get('tipotransaccions/edit/(:num)', 'TipoTransaccions::edit/$1');
    $routes->put('tipotransaccions/update/(:num)', 'TipoTransaccions::update/$1');
    $routes->delete('tipotransaccions/delete/(:num)', 'TipoTransaccions::delete/$1');

    $routes->get('usuarios', 'Usuarios::index');
    $routes->post('usuarios/create', 'Usuarios::create');
    $routes->get('usuarios/edit/(:num)', 'Usuarios::edit/$1');
    $routes->put('usuarios/update/(:num)', 'Usuarios::update/$1');
    $routes->delete('usuarios/delete/(:num)', 'Usuarios::delete/$1');

    $routes->get('rols', 'Rols::index');
    $routes->post('rols/create', 'Rols::create');
    $routes->get('rols/edit/(:num)', 'Rols::edit/$1');
    $routes->put('rols/update/(:num)', 'Rols::update/$1');
    $routes->delete('rols/delete/(:num)', 'Rols::delete/$1');

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

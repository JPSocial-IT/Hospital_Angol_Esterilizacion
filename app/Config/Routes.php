<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('IniPageController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Authentication Routing ---- Removed 
// $routes->match(['get', 'post'], 'auth-login', 'AuthController::login');
// $routes->match(['get', 'post'], 'auth-register', 'AuthController::register');
// $routes->match(['get', 'post'], 'auth-recoverpw', 'AuthController::recoverpw');
// $routes->match(['get', 'post'], 'auth-updatepw', 'AuthController::updatepw');
// $routes->get('auth-logout', 'AuthController::logout');

$routes->get('/', 'IniPageController::index');

// MANTENEDOR DEMO... (QUITAR AL PASAR A PRODUCCIÓN)
// $routes->get('MantenedorDemo', 'MantenedorDemo::index');
// $routes->get('MA_estado_solicitud', 'MA_estado_solicitud::index');
$routes->get('MA_bodegas', 'MA_bodegas::index');
$routes->get('ES_mantenedorAreas', 'ES_mantenedoresController::areas');
$routes->get('ES_mantenedorBodegas', 'ES_mantenedoresController::bodegas');
$routes->get('ES_mantenedorEstados_solicitud', 'ES_mantenedoresController::estados_solicitud');
$routes->get('ES_mantenedorEquipos', 'ES_mantenedoresController::equipos');
$routes->get('ES_mantenedorServicios', 'ES_mantenedoresController::servicios');

$routes->get('Principal', 'PrincipalController::index');


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
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
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('dashboard');
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
$routes->get('/', 'Dashboard::login');
$routes->get('/login', 'Dashboard::login');
$routes->post('/dashboard', 'Dashboard::iniciarSesion');
$routes->get('/dashboard', 'Dashboard::index',['filter'=>'pruebaFiltro']);
$routes->get('/dashboard/cerrar','Dashboard::cerrarSesion',['filter'=>'pruebaFiltro']);
$routes->get('/centro-computo','CentroComputoController::index',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->get('/centro-computo/addEdit/(:num)','CentroComputoController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/centro-computo/addEdit/(:num)','CentroComputoController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/centro-computo/delete','CentroComputoController::delete',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->get('/usuario','UsuarioController::index',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro','filter'=>'accesoFiltro']);
$routes->get('/usuario/addEdit/(:num)','UsuarioController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/usuario/addEdit/(:num)','UsuarioController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->get('/dispositivo','DispositivoController::index',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->get('/dispositivo/addEdit/(:num)','DispositivoController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/dispositivo/addEdit/(:num)','DispositivoController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/dispositivo/delete','DispositivoController::delete',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->get('/tipo-incidente','TipoIncidenteController::index',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/tipo-incidente/addEdit/(:num)','TipoIncidenteController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->get('/tipo-incidente/addEdit/(:num)','TipoIncidenteController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/tipo-incidente/delete','TipoIncidenteController::delete',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->get('/incidente','IncidenteController::index',['filter'=>'pruebaFiltro']);
$routes->post('/incidente/action','IncidenteController::action');
$routes->get('/incidente/addEdit/(:num)','IncidenteController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/incidente/addEdit/(:num)','IncidenteController::addEdit/$1',['filter'=>'pruebaFiltro']);
$routes->get('/bitacora','BitacoraController::index',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
$routes->post('/bitacora/addEdit/(:num)','BitacoraController::addEdit/$1',['filter'=>'pruebaFiltro','filter'=>'accesoFiltro']);
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

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'CoInicio::index');
$routes->get('login', 'CoInicio::index');
$routes->get('register', 'CoInicio::register');
$routes->post('register-validate', 'CoInicio::registerValidate');

$routes->post('login-validate', 'CoInicio::login');
$routes->get('logout', 'CoInicio::Logout');

/* Administracion */
$routes->group('admin',['filter'=>'auth'], static function ($routes) {

    $routes->get('/', 'CoAdministracion::index');
    $routes->get('aceptarsoli/(:any)', 'CoAdministracion::aceptarSolicitud/$1');
    $routes->get('rechazarsoli/(:any)', 'CoAdministracion::rechazarSolicitud/$1');

});

/* Panel */
$routes->group('panel',['filter'=>'auth'], static function ($routes) {

    $routes->get('/', 'CoPanel::index');
    $routes->post('adddeposito', 'CoPanel::addSolicitudDeposito', ['filter'=>'auth'],);
    $routes->post('addretiro', 'CoPanel::addSolicitudRetiro', ['filter'=>'auth'],);
    $routes->get('delsoli/(:any)', 'CoPanel::delSolicitud/$1');

});

/* User */
$routes->get('user', 'CoUsuario::index', ['filter'=>'auth'],);
$routes->post('user-add', 'CoUsuario::addUser', ['filter'=>'auth'],);
$routes->get('user-edt/(:any)', 'CoUsuario::edtUser/$1', ['filter'=>'auth'],);
$routes->post('user-upd/(:any)', 'CoUsuario::updUser/$1', ['filter'=>'auth'],);
$routes->get('user-estatus/(:any)', 'CoUsuario::estatusUser/$1', ['filter'=>'auth'],);

/* Verify Permission */
$routes->group('verify', static function ($routes) {

    $routes->get('/', 'CoBase::index');
    $routes->post('permissions/(:any)', 'CoBase::verifyPermissions/$1');
});


/* API V1 */
$routes->group('api/v1', static function ($routes) {

    $routes->get('allmysoli', 'CoPanel::allMySoli');
    $routes->get('allmysolihistory', 'CoPanel::allMySoliHistory');

    $routes->get('allsoliforadmin', 'CoAdministracion::allSoliForAdmin');
    $routes->get('allhistoryforadmin', 'CoAdministracion::allHistoryForAdmin');

    $routes->get('alluser', 'CoUsuario::allUser');
    $routes->get('allactiveuser', 'CoUsuario::allActiveUser');

});

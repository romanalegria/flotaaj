<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();


//controlando el logout automatico
//Route::post ('/logout', ' UsuarioController@performLogout ');
//Auth::logout ();


Route::get('flota/vehiculo/mantencion','VehiculoController@createman');
Route::get('flota/vehiculo/{id}/planificaMan','VehiculoController@createplan');
Route::get('flota/vehiculo/{id}/Planificacion','VehiculoController@Planificacion'); //planificar mantenciones
Route::get('flota/vehiculo/{id}/documentos','VehiculoController@cargardoc');
Route::post('flota/vehiculo/{id}/documentos','VehiculoController@creardoc');
Route::post('flota/vehiculo/{id}/mantencion','VehiculoController@storeman');
Route::post('flota/vehiculo/{id}/planificaMan','VehiculoController@storeplan');
Route::delete('flota/vehiculo/documentos','VehiculoController@deletedoc');


//Mantenedor de Maestros
Route::resource('maestros/areas','AreaController');
Route::resource('maestros/encargados','EncargadoController');
Route::resource('maestros/estados','EstadoController');
Route::resource('maestros/categorias','CategoriaController');
Route::resource('maestros/flotas','FlotaController');
Route::resource('flota/vehiculo','VehiculoController');
Route::resource('maestros/documentos','DocumentoController');
Route::resource('maestros/cargos','CargoController');
Route::resource('maestros/usuarios','UsuarioController');
Route::resource('maestros/zonas','ZonaController');
Route::resource('maestros/gastos','GastoController');
Route::resource('maestros/topes','TopeController');

//incidencias
//SSGG
	Route::resource('Tickets/ssgg','SsggController');
	Route::post('Tickets/ssgg/{id}/edit','SsggController@update');
	Route::post('Tickets/ssgg/create','SsggController@crearssgg');




//Asignaciones de Vehiculos
Route::resource('asignaciones','AsignarController');
Route::get('asignaciones/{id}/devolucion','AsignarController@edit_asignacion');
Route::get('asignaciones/{id}/verUnaAsignacion','AsignarController@verUnaAsignacion');
//Route::get('asignaciones/{id}/asignaciones','AsignarController@ver_asignaciones');
Route::get('asignaciones/{id}/asignaciones', [
    'as' => 'misAsignaciones',
    'uses' => 'AsignarController@ver_asignaciones',
]);
//Imprime acta de entrega
Route::get('asignaciones/{id}/actaentrega','AsignarController@pdfEntrega');

//Devolución de Vehiculo
Route::post('devoluciones','DevolucionController@devolucion');
Route::get('asignaciones/{id}/actadevolucion','DevolucionController@pdfDevolucion');
Route::get('devoluciones/{id}/ver_devolucion','DevolucionController@verDevolucion');


//Mantencion de vehiculo
Route::get('flota/vehiculo/{id}/misMantenciones', [
    'as' => 'misMantenciones',
    'uses' => 'VehiculoController@ver_mantenciones',
]);


//Ejemplo de exportacion a Excel
Route::get('index' ,['as'=>'index', 'uses' => 'ExcelController@index']);
Route::get('mismantenciones_excel' ,['as'=>'mismantenciones_excel', 'uses' => 'ExcelController@mismantenciones_excel']);

//Mis mantenciones
Route::get('mismantenciones/{idusuario}/{nombreuser}/{idvehiculo}/{vehiculonombre}', [
    'as' => 'mismantenciones',
    'uses' => 'VehiculoController@mismantenciones',
]);

//Tabla Mantenciones dentro de Servicio
Route::get('Servicios/Mantenciones', 'ServicioController@index');
//Generar Matriz de Mantencion



// * RENDICIONES * //
//Solicitudes
Route::resource('rendiciones/solicitudes','RendicionController');
Route::get('rendiciones/solicitudes/{id}/misSolicitudes', [
    'as' => 'misSolicitudes',
    'uses' => 'RendicionController@ver_solicitudes',
]);

//ver mis rendiciones
Route::get('rendiciones/solicitudes/{id}/misRendiciones', [
    'as' => 'misRendiciones',
    'uses' => 'RendicionController@ver_rendiciones',
]);

//Solicitudes para rendir
Route::get('rendiciones/solicitudes/{id}/misSolicitudesRendir', [
    'as' => 'misSolicitudesRendinr',
    'uses' => 'RendicionController@verSolicitudesRendir',
]);

//Ruta para validacion linea a linea por parte del jefe directo de un rendicion de fondos 
Route::get('rendiciones/{id}/validaRendicionJefe', [
    'as' => 'validaRendicionJefe',
    'uses' => 'RendicionController@validaRendicionJefe',
]);

Route::get('rendiciones/solicitudes/{id}/verSolicitud', [
    'as' => 'verSolicitud',
    'uses' => 'RendicionController@ver_una_solicitude',
]);

Route::put('rendiciones/solicitudes/{id}/verSolicitud', [
    'as' => 'updateSolicitud',
    'uses' => 'RendicionController@update',
]);

Route::get('autorizacion/autorizar','RendicionController@autorizar');

Route::get('detalle/{id}/gastos', [
    'as' => 'detalleGastos',
    'uses' => 'RendicionController@verGastosProyecto',
]);

//Rendiciones
Route::get('Rendiciones/rendiciones','RendicionController@indexRendicion');
Route::get('Rendiciones/rendiciones/{id}/CargarSolicitud','RendicionController@CargarSolicitud');
Route::post('Rendiciones/rendiciones','RendicionController@storeRendicionDos');
Route::post('Rendiciones/pasorendicion','RendicionController@storeRendicionPaso');
Route::post('Rendiciones/rendiciones-final','RendicionController@storeRendicionDosV2');
Route::get('rendiciones/solicitudes/{id}/miRendicion', [
    'as' => 'miRendicion',
    'uses' => 'RendicionController@miRendicion',
]);


Route::get('rendiciones/solicitudes/{id}/miRendicion2', [
    'as' => 'miRendicion2',
    'uses' => 'RendicionController@miRendicion2',
]);

Route::get('rendiciones/rendicion/{id}', [
    'as' => 'miRendicion3',
    'uses' => 'RendicionController@rendi3',
]);


Route::get('Rendiciones/validarMonto', [
    'as' => 'validarMonto',
    'uses' => 'RendicionController@validarMonto',
]);


Route::get('Rendiciones/validarExiste', [
    'as' => 'validarExiste',
    'uses' => 'RendicionController@validarExiste',
]);

Route::get('Rendiciones/recargarDetalle/{id}', [
    'as' => 'recargarDetalle',
    'uses' => 'RendicionController@recargarDetalle',
]);

Route::delete('/Rendiciones/eliminarFilaPaso/{id}', [
    'as' => 'eliminarFilaPaso',
    'uses' => 'RendicionController@eliminarFilaPaso',
]);

Route::get('/Rendiciones/editarFilaPaso/{id}', [
    'as' => 'editarFilaPaso',
    'uses' => 'RendicionController@editarFilaPaso',
]);


//CONTROL DE ARRIENDO OCASIONAL
Route::resource('arriendos','ArriendoController');
//Route::post('arriendos','ArriendoController@CrearArriendo');
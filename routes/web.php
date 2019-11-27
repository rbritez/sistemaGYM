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
    return view('index');
});

Route::resources([
    'turnos' => 'TurnoControlador',
    'rutinas' => 'RutinaControlador',
    'empleados' => 'EmpleadoControlador',
    'clientes' => 'ClientesControlador',
    'planes' => 'PlanControlador',
    'inscripciones' => 'InscripcionControlador',
    'maquinas' => 'MaquinaControlador',
    'pagos' => 'PagoControlador',
    'ingresos' => 'IngresoControlador',
    'fichamedica' => 'FichamedicaControlador',
    'productos' => 'ProductosControlador',
    'proveedores' => 'ProveedoresControlador',
    'categorias' => 'CategoriasControlador',
    'compras' => 'ComprasControlador',
]);
Route::get('empleados/ingresos/{id}','EmpleadoControlador@ingresos')->name('empleados.ingresos');
Route::post('empleados/destroy/{id}','EmpleadoControlador@destroy')->name('empleadodestroy');
Route::post('clientes/ultimoPlan','ClientesControlador@ultimoPlan')->name('clientes.ultimoPlan');
Route::post('rutinas/index','RutinaControlador@filtrarejercicio')->name('rutina.filtrarejercicio');
Route::post('rutinas/listarrutina','RutinaControlador@listarrutina')->name('rutina.listarrutina');
Route::post('rutina/cambiarestado','RutinaControlador@cambiarestado')->name('rutinas.cambiarestado');
Route::post('rutina/traerdias','RutinaControlador@traerdias')->name('rutinas.traerdias');
Route::post('rutina/editRutina','RutinaControlador@editRutina')->name('rutinas.editRutina');
Route::post('rutina/editEjercicios','RutinaControlador@editEjercicios')->name('rutinas.editEjercicios');
Route::post('rutina/traerejerciciosfiltro','RutinaControlador@traerejerciciosfiltro')->name('rutinas.traerejerciciosfiltro');
Route::post('clientes/precio','ClientesControlador@precio')->name('clientes.precio');
Route::prefix('rutina_maquinas')->name('rutina_maquinas.')->group(function () {
    Route::post('/', 'RutinaMaquinaControlador@store')->name('store');
    Route::delete('/', 'RutinaMaquinaControlador@delete')->name('delete');
});

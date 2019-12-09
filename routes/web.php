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
    'fichamedica' => 'FMControlador',
    'productos' => 'ProductosControlador',
    'proveedores' => 'ProveedoresControlador',
    'categorias' => 'CategoriasControlador',
    'compras' => 'ComprasControlador',
    'ejercicios'=>'EjerciciosControlador',
    'SectorCorporal'=> 'SectorCorporalControlador',
    'principal'=> 'PrincipalControlador',
]);

Route::get('empleados/ingresos/{id}','EmpleadoControlador@ingresos')->name('empleados.ingresos');
Route::get('planes/show/{id}','PlanControlador@show')->name('planes.show');
Route::get('rutinas/rutinaPDF/{id}','RutinaControlador@rutinaPDF')->name('rutinas.rutinaPDF');
Route::post('empleados/destroy/{id}','EmpleadoControlador@destroy')->name('empleadodestroy');
Route::post('pagos/montoDia','PagoControlador@montoDia')->name('pagos.montoDia');
Route::post('empleados/asistencias','EmpleadoControlador@asistencias')->name('empleados.asistencias');
Route::post('clientes/totalMes','ClientesControlador@totalMes')->name('clientes.totalMes');
Route::post('clientes/constantes','ClientesControlador@constantes')->name('clientes.constantes');
Route::get('ejercicios/destroy/{id}','EjerciciosControlador@destroy')->name('ejercicios.destroy');
Route::post('clientes/ultimoPlan','ClientesControlador@ultimoPlan')->name('clientes.ultimoPlan');
Route::post('rutinas/index','RutinaControlador@filtrarejercicio')->name('rutina.filtrarejercicio');
Route::post('ejercicios/mostrarr','EjerciciosControlador@mostrarr')->name('ejercicios.mostrarr');
Route::post('clientes/mostrar','ClientesControlador@mostrar')->name('clientes.mostrar');
Route::post('fichamedica/mostrar','FMControlador@mostrar')->name('fichamedica.mostrar');
Route::post('fichamedica/filtrarFecha','FMControlador@filtrarFecha')->name('fichamedica.filtrarFecha');
Route::get('fichamedica/mostrarFichaMedica/{id}','FMControlador@mostrarFichaMedica')->name('fichamedica.mostrarFichaMedica');
Route::post('SectorCoporal/mostrar','SectorCorporalControlador@mostrar')->name('SectorCorporal.mostrar');
Route::post('rutinas/listarrutina','RutinaControlador@listarrutina')->name('rutina.listarrutina');
Route::post('rutina/cambiarestado','RutinaControlador@cambiarestado')->name('rutinas.cambiarestado');
Route::post('rutina/traerdias','RutinaControlador@traerdias')->name('rutinas.traerdias');
Route::post('rutina/editRutina','RutinaControlador@editRutina')->name('rutinas.editRutina');
Route::post('rutina/editEjercicios','RutinaControlador@editEjercicios')->name('rutinas.editEjercicios');
Route::post('SectorCorporal/listar','SectorCorporalControlador@listar')->name('SectorCorporal.listar');
Route::post('rutina/traerejerciciosfiltro','RutinaControlador@traerejerciciosfiltro')->name('rutinas.traerejerciciosfiltro');
Route::post('clientes/precio','ClientesControlador@precio')->name('clientes.precio');
Route::prefix('rutina_maquinas')->name('rutina_maquinas.')->group(function () {
    Route::post('/', 'RutinaMaquinaControlador@store')->name('store');
    Route::delete('/', 'RutinaMaquinaControlador@delete')->name('delete');
});

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
    'planes' => 'PlanControlador',
    'inscripciones' => 'InscripcionControlador',
    'maquinas' => 'MaquinaControlador',
    'pagos' => 'PagoControlador',
    'ingresos' => 'IngresoControlador',
    'fichamedica' => 'FichaMedicaControlador',
]);

Route::prefix('rutina_maquinas')->name('rutina_maquinas.')->group(function () {
    Route::post('/', 'RutinaMaquinaControlador@store')->name('store');
    Route::delete('/', 'RutinaMaquinaControlador@delete')->name('delete');
});

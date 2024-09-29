<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\DependencyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. Estas
| rutas están cargadas por el RouteServiceProvider y todas ellas estarán
| asignadas al grupo "web" middleware. ¡Haz algo grandioso!
|
*/

// Ruta principal para la página de inicio de sesión
Route::get('/', function () {
    return view('auth.login');
});

// Ruta para cerrar sesión
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Grupo de rutas bajo el prefijo 'cps'
Route::prefix('cps')->group(function () {

    // Rutas para Dependencias
    Route::controller(DependencyController::class)->group(function () {
        Route::get('/dependency', 'dependency')->name('cps.admin.dependency');
        Route::post('/storedependency', 'store')->name('cps.admin.dependencias.store');
        Route::put('/dependency/{id}', 'update')->name('cps.admin.dependence.update');
        Route::delete('/dependency/{id}', 'destroy')->name('cps.admin.dependence.destroy');
        Route::get('/dependencia/{id}/contratistas', 'getContratistas')->name('dependencia.contratistas');
    });

    // Rutas para Contratistas
    Route::controller(ContractorController::class)->group(function () {
        Route::get('/contractor', 'contractor')->name('cps.admin.contractor');
        Route::post('/storecontractor', 'store')->name('cps.admin.contractor.store');
        Route::put('/contractors/{id}', 'update')->name('cps.admin.contractor.update');
        Route::get('/search-contractors', 'search')->name('contractors.search');
    });

    // Rutas para Consultas de Contratistas
    Route::controller(HomeController::class)->group(function () {
        Route::get('/consultar-contratistas/{id}', 'consultarContratistas')->name('consultar.contratistas');
        Route::post('/consultacontratista', 'consulta')->name('cps.contratista.consulta');
    });

});

// Rutas de autenticación generadas por Laravel
Auth::routes();

// Ruta para el home después de iniciar sesión
Route::get('/home', [HomeController::class, 'index'])->name('home');

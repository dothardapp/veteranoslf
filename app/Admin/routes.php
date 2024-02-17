<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

use App\Admin\Controllers\HomeController;

use App\Admin\Controllers\EquipoController;
use App\Admin\Controllers\RepresentanteController;
use App\Admin\Controllers\CampeonatoController;
use App\Admin\Controllers\CanchaController;
use App\Admin\Controllers\PartidoController;
use App\Admin\Controllers\SorteoZonaController;
use App\Admin\Controllers\FixtureController;
use App\Admin\Controllers\VistaZonaController;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => 'App\\Admin\\Controllers', // Asegúrate de usar dobles barras invertidas para el espacio de nombres
    'middleware' => config('admin.route.middleware'),
    'as'         => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', [HomeController::class, 'index'])->name('home');
    
    $router->get('/vista_zonas', [VistaZonaController::class, 'index'])->name('vista_zonas');
    $router->get('/filtrar-campeonato', [VistaZonaController::class, 'filtrarPorCampeonato'])->name('filtrar-campeonato');
    $router->get('/mensaje', [VistaZonaController::class, 'message']);

    $router->resource('equipos', EquipoController::class);
    $router->resource('representantes', RepresentanteController::class);
    $router->resource('campeonatos', CampeonatoController::class);
    $router->resource('canchas', CanchaController::class);    
    $router->resource('zonas', SorteoZonaController::class);    
    $router->resource('fixtures', FixtureController::class);
});

<?php

use App\Http\Controllers\ProyectosController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MyMiddleware;
Route::get('proyectos', [ProyectosController::class, 'getIndex']);

Route::get('proyectos/show/{id}', [ProyectosController::class, 'getShow'])
->middleware(['id_mayor_de_10'.':9'])
->where('id', '[0-9]+');

Route::get('proyectos/create', [ProyectosController::class, 'getCreate']);

Route::get('proyectos/edit/{id}', [ProyectosController::class, 'getEdit'])->where('id', '[0-9]+');

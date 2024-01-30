<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SedeController;


Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function() {return view('home');})->name('home')->middleware('auth');

Route::get('area', [AreaController::class, 'index']);
Route::get('/area/index', [AreaController::class, 'index'])->name('area.index');
Route::get('/empleado/index', [EmployeeController::class, 'index'])->name('empleado.index');
Route::get('/cargo/index', [PositionController::class, 'index'])->name('cargo.index');
Route::get('/sede/index', [SedeController::class, 'index'])->name('sede.index');

/* Rutas de Departamento */
Route::get('/departamento/index', [DepartmentController::class, 'index'])->name('departamento.index');
Route::resource('departamento', DepartmentController::class)->names(['create' => 'departamento.creardepartamento',]);
Route::post('/departamento/create', [DepartmentController::class, 'creardepartamento'])->name('departamento.creardepartamento');
Route::get('/departamento/{id}/editar', [DepartmentController::class, 'edit'])->name('departamento.editar');
Route::put('/departamento/{departamento}', [DepartmentController::class, 'update'])->name('departamento.update');

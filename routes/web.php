<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SedeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function() {return view('home');})->name('home')->middleware('auth');

Route::get('area', [AreaController::class, 'index']);
Route::get('/area/index', [AreaController::class, 'index'])->name('area.index');
Route::get('/empleado/index', [EmployeeController::class, 'index'])->name('empleado.index');
Route::get('/departamento/index', [DepartmentController::class, 'index'])->name('departamento.index');
Route::get('/cargo/index', [PositionController::class, 'index'])->name('cargo.index');
Route::get('/sede/index', [SedeController::class, 'index'])->name('sede.index');




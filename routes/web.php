<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\EquipmentController;


Auth::routes();
Route::get('/', function(){ return view('auth.login');});
Route::get('/home', function() {return view('home');})->name('home')->middleware('auth');

/* Rutas de Departamento */
Route::get('/departamento/index', [DepartmentController::class, 'index'])->name('departamento.index')->middleware('auth');
Route::post('/departamento/create', [DepartmentController::class, 'creardepartamento'])->name('departamento.creardepartamento')->middleware('auth');
Route::get('/departamento/{id}/editar', [DepartmentController::class, 'edit'])->name('departamento.editar')->middleware('auth');
Route::get('/departamento/{id}/detalle', [DepartmentController::class, 'detalle'])->name('departamento.detalle')->middleware('auth');
Route::put('/departamento/{id}/update', [DepartmentController::class, 'update'])->name('departamento.update')->middleware('auth');
Route::delete('/departamento/{departamento}', [DepartmentController::class, 'delete'])->name('departamento.delete')->middleware('auth');

/* Rutas de Áreas */
Route::get('/area/index', [AreaController::class, 'index'])->name('area.index')->middleware('auth');
Route::post('/area/create', [AreaController::class, 'creararea'])->name('area.creararea')->middleware('auth');
Route::get('/area/{id}/detalle', [AreaController::class, 'detalle'])->name('area.detalle')->middleware('auth');
Route::put('/area/{id}/update', [AreaController::class, 'update'])->name('area.update')->middleware('auth');
Route::delete('/area/{area}', [AreaController::class, 'delete'])->name('area.delete')->middleware('auth');


/* Rutas de Cargos */
Route::post('/cargo/create', [PositionController::class, 'crearCargo'])->name('cargo.crearCargo')->middleware('auth');
Route::get('/cargo/index', [PositionController::class, 'index'])->name('cargo.index')->middleware('auth');
Route::get('/cargo/{id}/detalle', [PositionController::class, 'detalle'])->name('cargo.detalle')->middleware('auth');
Route::put('/cargo/{id}/update', [PositionController::class, 'update'])->name('cargo.update')->middleware('auth');
Route::delete('/cargo/{position}', [PositionController::class, 'delete'])->name('cargo.delete')->middleware('auth');

/* Rutas de sedes */
Route::post('/sede/create', [SedeController::class, 'crearsede'])->name('sede.crearsede')->middleware('auth');
Route::get('/sede/index', [SedeController::class, 'index'])->name('sede.index')->middleware('auth');
Route::get('/sede/{id}/detalle', [SedeController::class, 'detalle'])->name('sede.detalle')->middleware('auth');
Route::put('/sede/{id}/update', [SedeController::class, 'update'])->name('sede.update')->middleware('auth');
Route::delete('/sede/{sede}', [SedeController::class, 'delete'])->name('sede.delete')->middleware('auth');

/* Rutas de Empleado */
Route::get('/empleado/index', [EmployeeController::class, 'index'])->name('empleado.index')->middleware('auth');
Route::get('/empleado/{id}/cargar-datos', [EmployeeController::class, 'cargarDatos'])->name('empleado.cargar-datos')->middleware('auth');
Route::post('/empleado/crear', [EmployeeController::class, 'crearEmpleado'])->name('empleado.crearEmpleado')->middleware('auth');
Route::delete('/empleado/{employee}', [EmployeeController::class, 'delete'])->name('employee.delete')->middleware('auth');
Route::get('empleado/details', [EmployeeController::class, 'getEmployeeDetails'])->name('employee.details')->middleware('auth');/* DETALLES DE EMPLEADO MODAL OJITO */
Route::get('/employee/{id}/details', [EmployeeController::class, 'details']);
Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::get('/empleado/consultaempleado', [EmployeeController::class, 'consultaempleado'])->name('empleado.consultaempleado');
Route::get('/employee/empleadoarea/{areaId}', [EmployeeController::class, 'empleadoArea'])->name('employee.empleadoarea');
Route::get('/employee/empleadosporarea/{areaId}', [EmployeeController::class, 'empleadosPorArea'])->name('employee.empleadosporarea');


/* Rutas Gestion de Carnet */
Route::get('/carnet/index', [LicenseController::class, 'index'])->name('carnet.index')->middleware('auth');
Route::match(['get', 'post'], '/carnet/empleadolist', [LicenseController::class, 'empleadolist'])->middleware('auth');
Route::post('/carnet/generate-carnet', [LicenseController::class, 'generateCarnet'])->name('carnet.generate-carnet')->middleware('auth');
Route::get('/carnet/empleadodetails', [LicenseController::class, 'getEmployeeDetails'])->name('carnet.empleadodetails');
Route::get('/carnet/preview', [LicenseController::class, 'preview'])->name('carnet.preview');

/* Rutas Gestion de Actas de ENTREGA Carnet empresarial */
Route::get('/carnet/acta', [LicenseController::class, 'acta'])->name('carnet.acta');
Route::get('/carnet/generate-actas/{ids}', [LicenseController::class, 'generateActas'])->name('carnet.generateActas');





/*Equipment Routes*/
Route::get('/Equipment/View/PNY', [EquipmentController::class, 'EquipmentView_PNY'])->name('Equipment.View.PNY');
Route::get('/EquipmentAssing/PNY', [EquipmentController::class, 'EquipmentAssing_PNY'])->name('Equipment.Assing.PNY');
Route::get('/EquipmentConsulte/PNY', [EquipmentController::class, 'EquipmentConsulte_PNY'])->name('Equioment.Consulte.PNY');

/*routes equipments functions*/
Route::post('/Create/Equipment/PNY', [EquipmentController::class, 'EquipmentCreate_PNY'])->name('Create.Equipment.PNY');
Route::delete('/Delete/Equipment/{Equipment}/PNY', [EquipmentController::class,'EquipmentDelete_PNY'])->name('Delete.Equipment.PNY');
Route::get('/Equipment/{id}/Detail/PNY', [EquipmentController::class, 'EquipmentDetail_PNY'])->name('Detail.Equipment.PNY');
Route::get('/Equipment/{id}/View/Inf/PNY', [EquipmentController::class, 'ViewInfEquipment_PNY'])->name('View.inf.Equipment.PNY');
Route::get('/Equipment/PrinterLoan/PNY', [EquipmentController::class, 'PrinterLoanView_PNY'])->name('PrinterLoan.PNY');
Route::put('/Equipment/{id}/Update/PNY', [EquipmentController::class, 'EquipmentUpdate_PNY'])->name('Update.Equipment.PNY');

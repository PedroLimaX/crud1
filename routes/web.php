<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\EntregableController;
use App\Http\Controllers\RequerimientoController;
use App\Http\Controllers\RecursoController;

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
    return view('auth.login');
});

/*
Route::get('/alumno', function () {
    return view('alumno.index');
});

Route::get('/alumno/create', [AlumnoController::class, 'create']);
*/
Route::resource('/alumno', AlumnoController::class)->middleware('auth');
Auth::routes(['reset'=>false]);

Route::get('/home', [AlumnoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
    //Route::get('/', [AlumnoController::class, 'index'])->name('home');
});

Route::resource('/docente', DocenteController::class)->middleware('auth');
Auth::routes(['reset'=>false]);

Route::get('/home', [DocenteController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
    //Route::get('/', [DocenteController::class, 'index'])->name('home');
});

Route::resource('/proyecto', ProyectoController::class)->middleware('auth');
Auth::routes(['reset'=>false]);

Route::get('/home', [ProyectoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/', [ProyectoController::class, 'index'])->name('home');
});

Route::resource('/equipo', EquipoController::class)->middleware('auth');
Auth::routes(['reset'=>false]);

Route::get('/home', [EquipoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [EquipoController::class, 'index'])->name('home');
});

Route::resource('/user', UserController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [UserController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [UserController::class, 'index'])->name('home');
});

Route::resource('/empresa', EmpresaController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [EmpresaController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [UserController::class, 'index'])->name('home');
});


Route::resource('/carrera', CarreraController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [CarreraController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [UserController::class, 'index'])->name('home');
});

Route::resource('/proyecto/fase', FaseController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [FaseController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [UserController::class, 'index'])->name('home');
});

Route::resource('/proyecto/fase/entregable', EntregableController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [EntregableController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [UserController::class, 'index'])->name('home');
});

Route::resource('/proyecto/fase/entregable/requerimiento', RequerimientoController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [RequerimientoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [UserController::class, 'index'])->name('home');
});

Route::resource('/recurso', RecursoController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [RecursoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
   // Route::get('/', [UserController::class, 'index'])->name('home');
});
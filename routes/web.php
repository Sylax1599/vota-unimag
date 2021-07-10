<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganoController;
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
    return view('welcome');
});


Auth::routes();

Route::resource('home/candidatos', 'App\Http\Controllers\CandidatoController');
Route::resource('home/organos', 'App\Http\Controllers\OrganoController');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/inicio', [HomeController::class, 'inicio']);
Route::get('/inicio/votar/{id}', [HomeController::class, 'votar'])->name('candidatos')->where(['id' => '[0-9]+']);
Route::get('/inicio/votar/', [HomeController::class, 'error']);
Route::post('/inicio/votar', [HomeController::class, 'registrarVoto'])->name('registroVoto');

//Verificar si ha votado
Route::get('/api/votado/{id}', [HomeController::class, 'isVotado']);

//cargar a los candidatos a la vista
Route::get('/api/votar/{id}', [HomeController::class, 'apiVotar']);

//Obtener organos
Route::get('/api/organos/', [HomeController::class, 'apiOrganos']);


//Vista total de votos por candidato
Route::get('/home/total/', [HomeController::class, 'viewVotos']);
//API para extraer datos
Route::get('/api/total/', [HomeController::class, 'apiTotalVotos']);

//Importar usuario
Route::get('/home/users/import',[UserController::class,'importForm'])->name('users.importForm');
Route::post('/home/users/import',[UserController::class, 'import'])->name('users.import');
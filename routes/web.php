<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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
Route::get('/inicio/votar/{id}', [HomeController::class, 'votar']);
Route::post('/inicio/votar', [HomeController::class, 'registrarVoto'])->name('registroVoto');



Route::get('/home/users/import',[UserController::class,'importForm'])->name('users.importForm');
Route::post('/home/users/import',[UserController::class, 'import'])->name('users.import');
<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {return view('welcome');});
Route::view('/', 'spa');

Route::get('/pizza/all', [\App\Http\Controllers\PizzaProductController::class, 'all']);
Route::post('/order/create', [\App\Http\Controllers\OrderController::class, 'create']);
Route::post('/order/fill', [\App\Http\Controllers\OrderController::class, 'fill']);
Route::get('/order/history', [\App\Http\Controllers\OrderController::class, 'history']);
Route::get('/order/spa-config', [\App\Http\Controllers\OrderController::class, 'spaConfig']);
Route::post('/auth/login', [\App\Http\Controllers\LoginController::class, 'authenticate']);
Route::post('/auth/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
Route::post('/auth/signup', [\App\Http\Controllers\LoginController::class, 'signup']);
Route::post('/auth/whoami', [\App\Http\Controllers\LoginController::class, 'whoami']);

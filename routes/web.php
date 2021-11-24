<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Middleware\checkDocentAdmin;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('createBoard',  [BoardController::class, 'createBoardForm'])->name('createBoard')->middleware('checkDocentAdmin');
Route::post('/home',  [BoardController::class, 'storeBoard'])->name('home')->middleware('checkDocentAdmin');
Route::get('oneBoard/{id}', [BoardController::class, 'oneBoard'])->name('oneBoard');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
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
Route::get('changeUserRoles',  [UserController::class, 'changeUserRolesPage'])->name('changeUserRoles')->middleware('checkDocentAdmin');
Route::get('changeUserForm/{id}',  [UserController::class, 'changeUserFormPage'])->name('changeUserForm')->middleware('checkDocentAdmin');
Route::get('destroyUserPage/{id}',  [UserController::class, 'destroyUserPage'])->name('destroyUserPage')->middleware('checkDocentAdmin');
Route::post('destroyUser/{id}',  [UserController::class, 'destroyUser'])->name('destroyUser')->middleware('checkDocentAdmin');
Route::put('updateUserRole/{id}',  [UserController::class, 'updateUserRole'])->name('updateUserRole')->middleware('checkDocentAdmin');
Route::post('/home',  [BoardController::class, 'storeBoard'])->name('home')->middleware('checkDocentAdmin');
Route::get('oneBoard/{board_id}', [BoardController::class, 'oneBoard'])->name('oneBoard');
Route::get('addStudentsToBoard/{board_id}',  [BoardController::class, 'addStudentsToBoard'])->name('addStudentsToBoard')->middleware('checkDocentAdmin');
Route::get('search/{board_id}', [BoardController::class, 'search'])->name('search')->middleware('checkDocentAdmin');
Route::get('addToBoard/{board_id}/{user_id}',  [BoardController::class, 'addToBoard'])->name('addToBoard')->middleware('checkDocentAdmin');



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Middleware\CheckTeacherOrAdmin;
use App\Http\Middleware\CheckAdmin;

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

/** board routes */
Route::post('/home',  [BoardController::class, 'storeBoard'])->name('home')->middleware('CheckTeacherOrAdmin');
Route::get('createBoard',  [BoardController::class, 'createBoardForm'])->name('createBoard')->middleware('CheckTeacherOrAdmin');
Route::get('oneBoard/{board_id}', [BoardController::class, 'oneBoard'])->name('oneBoard');
Route::get('addStudentsToBoard/{board_id}',  [BoardController::class, 'addStudentsToBoard'])->name('addStudentsToBoard')->middleware('CheckTeacherOrAdmin');
Route::get('search/{board_id}', [BoardController::class, 'search'])->name('search')->middleware('CheckTeacherOrAdmin');
Route::get('addToBoard/{board_id}/{user_id}',  [BoardController::class, 'addToBoard'])->name('addToBoard')->middleware('CheckTeacherOrAdmin');

/** admin routes */
Route::get('admin/user-overview',  [UserController::class, 'changeUserRolesPage'])->name('changeUserRoles')->middleware('CheckAdmin');
Route::get('admin/change-user-role/{id}',  [UserController::class, 'changeUserFormPage'])->name('changeUserForm')->middleware('CheckAdmin');
Route::post('updateUserRole/{id}',  [UserController::class, 'updateUserRole'])->name('updateUserRole')->middleware('CheckAdmin');
Route::get('admin/confirm-delete/{id}',  [UserController::class, 'destroyUserPage'])->name('destroyUserPage')->middleware('CheckAdmin');
Route::post('destroyUser/{id}',  [UserController::class, 'destroyUser'])->name('destroyUser')->middleware('CheckAdmin');
Route::get('admin/search-user', [UserController::class, 'searchAdminPage'])->name('searchAdminPage')->middleware('CheckAdmin');


/** card routes */
Route::get('boardCrud/createCard/{board_id}',  [CardController::class, 'addACard'])->name('addACard');
Route::post('storeCard/{board_id}',  [CardController::class, 'storeCard'])->name('storeCard');
Route::get('searchAdminPage', [UserController::class, 'searchAdminPage'])->name('searchAdminPage')->middleware('CheckTeacherOrAdmin');
Route::get('boardCrud/createLessCard/{board_id}',  [CardController::class, 'createLessCard'])->name('createLessCard');
Route::post('storeLessonCard/{board_id}',  [CardController::class, 'storeLessonCard'])->name('storeLessonCard');
Route::get('storeLessonUpVote/{lesson_id}/{board_id}',  [CardController::class, 'storeLessonUpVote'])->name('storeLessonUpVote');
Route::post('getCardInfo/{lesson_id}/{board_id}',  [CardController::class, 'getCardInfo'])->name('getCardInfo');




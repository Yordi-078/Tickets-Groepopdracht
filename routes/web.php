<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LessonCardController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckTeacherOrAdmin;
use App\Http\Middleware\CheckLoggedIn;
use App\Http\Middleware\Authenticate;
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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('CheckLoggedIn');
/** board routes */
Route::post('/home',  [BoardController::class, 'storeBoard'])->name('home')->middleware('CheckTeacherOrAdmin');
Route::get('createBoard',  [BoardController::class, 'createBoardForm'])->name('createBoard')->middleware('CheckTeacherOrAdmin');
Route::get('oneBoard/{board_id}', [BoardController::class, 'oneBoard'])->name('oneBoard')->middleware('CheckLoggedIn');
Route::get('addStudentsToBoard/{board_id}',  [BoardController::class, 'addStudentsToBoard'])->name('addStudentsToBoard')->middleware('CheckTeacherOrAdmin');
Route::get('search/{input}/{board_id}', [BoardController::class, 'searchStudents'])->name('search')->middleware('CheckTeacherOrAdmin');
Route::get('addToBoard/{board_id}/{user_id}',  [BoardController::class, 'addToBoard'])->name('addToBoard')->middleware('CheckTeacherOrAdmin');
Route::get('viewUsersFromBoard/{board_id}', [BoardController::class, 'viewUsersFromBoard'])->name('viewUsersFromBoard');
Route::get('viewUserPage/{user_id}', [BoardController::class, 'viewUserPage'])->name('viewUserPage')->middleware('CheckLoggedIn');

/** admin routes */
Route::get('admin/user-overview',  [UserController::class, 'changeUserRolesPage'])->name('changeUserRoles')->middleware('CheckAdmin');
Route::get('admin/change-user-role/{id}',  [UserController::class, 'changeUserFormPage'])->name('changeUserForm')->middleware('CheckAdmin');
Route::post('updateUserRole/{id}',  [UserController::class, 'updateUserRole'])->name('updateUserRole')->middleware('CheckAdmin');
Route::get('admin/confirm-delete/{id}',  [UserController::class, 'destroyUserPage'])->name('destroyUserPage')->middleware('CheckAdmin');
Route::post('destroyUser/{id}',  [UserController::class, 'destroyUser'])->name('destroyUser')->middleware('CheckAdmin');
Route::get('admin/search-user', [UserController::class, 'searchAdminPage'])->name('searchAdminPage')->middleware('CheckAdmin');

/** teacher dashboard routes */
route::get('teacher/dashboard/{board_id}', [UserController::class, 'teacherDashboard'])->name('teacherDashboard')->middleware('CheckTeacher');
route::get('teacher/dashboard/{board_id}/date/{selectedDate}', [UserController::class, 'dateSelected'])->name('dateSelected')->middleware('CheckTeacher');

/** card routes */
Route::get('boardCrud/createCard/{board_id}',  [CardController::class, 'addACard'])->name('addACard')->middleware('CheckLoggedIn');
Route::post('storeCard/{board_id}',  [CardController::class, 'storeCard'])->name('storeCard')->middleware('CheckLoggedIn');
Route::get('searchUser/{input}', [UserController::class, 'searchUser'])->name('searchUser')->middleware('CheckTeacherOrAdmin');
Route::get('boardCrud/createLessCard/{board_id}',  [CardController::class, 'createLessCard'])->name('createLessCard')->middleware('CheckLoggedIn');
Route::post('storeLessonCard/{board_id}',  [CardController::class, 'storeLessonCard'])->name('storeLessonCard')->middleware('CheckLoggedIn');
Route::get('storeLessonUpVote/{lesson_id}/{board_id}',  [CardController::class, 'storeLessonUpVote'])->name('storeLessonUpVote');
Route::get('getCardInfo/{lesson_id}',  [CardController::class, 'getCardInfo'])->name('getCardInfo')->middleware('CheckLoggedIn');
// Route::get('storeCardUpVote/{card_id}/{board_id}',  [CardController::class, 'storeCardUpVote'])->name('storeCardUpVote');


route::get('fetchAllUsers', [UserController::class, 'fetchAllUsers'])->name('fetchAllUsers')->middleware('CheckTeacherOrAdmin');
Route::get('boardCrud/createLessonCard/{board_id}',  [LessonCardController::class, 'createLessonCard'])->name('createLessonCard')->middleware('CheckTeacherOrAdmin');
Route::post('storeLessonCard/{board_id}',  [LessonCardController::class, 'storeLessonCard'])->name('storeLessonCard')->middleware('CheckTeacherOrAdmin');
Route::get('storeLessonUpVote/{card_id}',  [LessonCardController::class, 'storeLessonUpVote'])->name('storeLessonUpVote')->middleware('CheckLoggedIn');
Route::get('getLessonCardInfo/{card_id}',  [LessonCardController::class, 'getLessonCardInfo'])->name('getLessonCardInfo')->middleware('CheckLoggedIn');


Route::get('getUsername/{user_id}/{helperId}',  [CardController::class, 'getUsername'])->name('getUsername')->middleware('CheckLoggedIn');
Route::get('getLessonOwner/{user_id}',  [CardController::class, 'getLessonOwner'])->name('getLessonOwner')->middleware('CheckLoggedIn');
Route::get('saveHelper/{card_id}/{helperId}',  [CardController::class, 'saveHelper'])->name('saveHelper')->middleware('CheckLoggedIn');
Route::get('removeHelper/{card_id}',  [CardController::class, 'removeHelper'])->name('removeHelper')->middleware('CheckLoggedIn');
Route::get('getQuestionCardInfo/{card_id}',  [CardController::class, 'getQuestionCardInfo'])->name('getQuestionCardInfo')->middleware('CheckLoggedIn');
Route::get('getLessonCardInfo/{card_id}',  [CardController::class, 'getLessonCardInfo'])->name('getLessonCardInfo')->middleware('CheckLoggedIn');
Route::get('saveCardUpvote/{card_id}',  [CardController::class, 'saveCardUpvote'])->name('saveCardUpvote')->middleware('CheckLoggedIn');
Route::get('saveLessonUpvote/{card_id}',  [CardController::class, 'saveLessonUpvote'])->name('saveLessonUpvote')->middleware('CheckLoggedIn');
Route::get('deleteCardUpvote/{card_id}',  [CardController::class, 'deleteCardUpvote'])->name('deleteCardUpvote')->middleware('CheckLoggedIn');
Route::get('deleteLessonUpvote/{card_id}',  [CardController::class, 'deleteLessonUpvote'])->name('deleteLessonUpvote')->middleware('CheckLoggedIn');
Route::get('GetCardAvatars/{card_id}',  [CardController::class, 'GetCardAvatars'])->name('GetCardAvatars')->middleware('CheckLoggedIn');
Route::get('updateCard/{card_id}/{card_name}/{card_description}/{card_status}',  [CardController::class, 'updateCard'])->name('updateCard')->middleware('CheckLoggedIn');




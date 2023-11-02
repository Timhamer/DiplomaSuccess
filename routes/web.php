<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/adduser', [UserController::class, 'index'])->name('adduser');
Route::post('/createuser', [UserController::class, 'create'])->name('createuser');
Route::get('/ActivateAccount/{code}', [UserController::class, 'activateAccount'])->name('activateAccount');
Route::post('/FinishAccount', [UserController::class,'update'])->name('finishuser');
Route::get('/Home', [ExamController::class, 'index'])->name('Home');



Route::get('/login', [UserController::class, 'createLogin'])->name('login');
Route::delete('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/loginUser', [UserController::class, 'loginUser'])->name('loginUser');
Route::get('/homeRedirect', [UserController::class, 'homeRedirect'])->name('homeRedirect');
Route::get('/studentDashboard', [UserController::class, 'teacherRedirect'])->name('studentDashboard');
Route::post('/examenToevoegen', [TeacherController::class, 'examenToevoegen'])->name('examenToevoegen');

Route::post('/opleidingToevoegen', [TeacherController::class, 'opleidingToevoegen'])->name('opleidingToevoegen');


Route::get('/studentDash', [StudentController::class, 'index'])->name('studentDash');

Route::get('/examine', [ExamController::class, 'index'])->name('Examine');

Route::get('/editExam', [ExamController::class, 'EditExam'])->name('EditExam');
Route::post('/save-form-data', 'FormController@saveFormData')->name('saveFormData');

Route::get('/editExam', function () {
    return view('editDocument', ['showFirstSet' => true]);
});

Route::post('/editExam', function () {
    $showFirstSet = request('option') === 'yes';
    return view('editDocument', compact('showFirstSet'));
});

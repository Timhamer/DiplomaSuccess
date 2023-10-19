<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::get('/login', [UserController::class, 'createLogin'])->name('login');
Route::post('/loginUser', [UserController::class, 'loginUser'])->name('loginUser');
Route::get('/homeRedirect', [UserController::class, 'homeRedirect'])->name('homeRedirect');
Route::get('/studentDashboard', [UserController::class, 'teacherRedirect'])->name('studentDashboard');




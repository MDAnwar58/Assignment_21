<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Frontend\FrontendHomeController;
use App\Http\Controllers\Backend\UserTodoController;
use App\Http\Middleware\UserTokenVerify;
use Illuminate\Support\Facades\Route;

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



// auth pages routes
Route::get('/login' , [AuthController::class, 'login'])->name('login.page');
Route::get('/register' , [AuthController::class, 'register'])->name('register.page');

// auth api routes
Route::post('/login' , [AuthController::class, 'loginRequest']);
Route::post('/register' , [AuthController::class, 'registerRequest']);
Route::get('/logout' , [AuthController::class, 'logout'])->middleware(UserTokenVerify::class);

// frontend page route
Route::get('/' , [FrontendHomeController::class, 'index'])->name('frontend.home')->middleware(UserTokenVerify::class);
// backend pages route
Route::get('/admin/home' , [HomeController::class, 'index'])->name('admin.home')->middleware(UserTokenVerify::class);

// user todo pages routes
Route::get('/user-create-page' , [UserTodoController::class, 'userCreatePage'])->name('create.user');
Route::get('/user-edit-page' , [UserTodoController::class, 'userEditPage'])->name('edit.user');
Route::get('/user-read-page' , [UserTodoController::class, 'userReadPage'])->name('read.user');

// user api routes
Route::get('/user-get' , [UserTodoController::class, 'userGet']);
Route::post('/user-create' , [UserTodoController::class, 'userCreate']);
Route::get('/user-info-show/{email}' , [UserTodoController::class, 'userInfoShow']);
Route::get('/user-read/{email}' , [UserTodoController::class, 'userRead']);
Route::get('/user-get-edit/{email}' , [UserTodoController::class, 'userGetEdit']);
Route::post('/user-update' , [UserTodoController::class, 'userUpdate']);
Route::get('/user-delete/{email}' , [UserTodoController::class, 'userDelete']);

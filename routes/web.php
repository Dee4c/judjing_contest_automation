<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\UserManagementController;


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

Route::redirect('/', '/login'); 
Route::get('/login', [UserAuthenticationController::class,'login'])->middleware('alreadyLoggedIn');
Route::post('login-user', [UserAuthenticationController::class,'loginUser'])->name('login-user');
Route::get('/usermanage/dashboard', [UserAuthenticationController::class,'dashboard'])->middleware('isLoggedIn');
Route::get('/logout', [UserAuthenticationController::class, 'logout'])->name('logout');
Route::get('/usermanage/addjudge', [UserManagementController::class, 'addJudgeForm'])->name('addJudgeForm');
Route::post('/usermanage/addjudge', [UserManagementController::class, 'addJudge'])->name('addJudge');
Route::delete('/user/{id}', [UserAuthenticationController::class, 'deleteUser'])->name('user.delete');



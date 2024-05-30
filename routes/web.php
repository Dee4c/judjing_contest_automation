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
Route::get('/usermanage/dashboard', [UserAuthenticationController::class,'dashboard'])->middleware('isLoggedIn')->name('usermanage.dashboard');
Route::get('/logout', [UserAuthenticationController::class, 'logout'])->name('logout');
Route::get('/usermanage/addjudge', [UserManagementController::class, 'addJudgeForm'])->name('addJudgeForm');
Route::post('/usermanage/addjudge', [UserManagementController::class, 'addJudge'])->name('addJudge');
Route::delete('/user/{id}', [UserManagementController::class, 'deleteUser'])->name('user.delete');
Route::put('/user/{id}', [UserManagementController::class, 'updateUser'])->middleware('isLoggedIn')->name('user.update');
Route::get('/candidate/dashboard', [UserManagementController::class, 'candidateDashboard'])->middleware('isLoggedIn')->name('candidate.dashboard');
Route::post('/candidate/add', [UserManagementController::class, 'addCandidate'])->middleware('isLoggedIn')->name('candidate.add');
Route::get('/judge/judgeDashboard', [UserAuthenticationController::class, 'judgeDashboard'])->middleware('isLoggedIn')->name('judge.judge_dashboard');








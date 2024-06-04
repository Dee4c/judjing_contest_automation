<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\UserManagementController;

Route::redirect('/', '/login'); 
Route::get('/login', [UserAuthenticationController::class, 'login'])->name('alreadyLoggedIn');
Route::post('login-user', [UserAuthenticationController::class, 'loginUser'])->name('login-user');
Route::get('/usermanage/dashboard', [UserAuthenticationController::class, 'dashboard'])->middleware('isLoggedIn')->name('usermanage.dashboard');
Route::get('/logout', [UserAuthenticationController::class, 'logout'])->name('logout');
Route::get('/usermanage/addjudge', [UserManagementController::class, 'addJudgeForm'])->middleware('isLoggedIn')->name('addJudgeForm');
Route::post('/usermanage/addjudge', [UserManagementController::class, 'addJudge'])->middleware('isLoggedIn')->name('addJudge');
Route::delete('/user/{id}', [UserManagementController::class, 'deleteUser'])->name('user.delete');
Route::put('/user/{id}', [UserManagementController::class, 'updateUser'])->middleware('isLoggedIn')->name('user.update');
Route::post('/candidates', [UserManagementController::class, 'storeCandidate'])->middleware('isLoggedIn')->name('candidate.store');
Route::get('/candidates/create', [UserManagementController::class, 'createCandidate'])->middleware('isLoggedIn')->name('candidate.create');
Route::get('/usermanage/candidate_dash', [UserManagementController::class, 'candidateDash'])->middleware('isLoggedIn')->name('usermanage.candidate_dash');
Route::delete('/candidates/{id}', [UserManagementController::class, 'deleteCandidate'])->middleware('isLoggedIn')->name('candidate.delete');
Route::put('/candidates/{id}', [UserManagementController::class, 'updateCandidate'])->middleware('isLoggedIn')->name('candidate.update');
Route::get('/usermanage/preliminary_dash', [UserManagementController::class, 'preliminaryDash'])->name('usermanage.preliminary_dash');
Route::get('/judge/judgeDashboard', [UserManagementController::class, 'judgeDashboard'])->middleware('isLoggedIn')->name('judge.judge_dashboard');
Route::post('/scores', [UserManagementController::class, 'storeScore'])->middleware('isLoggedIn')->name('score.store');
Route::get('/pre-interview-scores', [UserManagementController::class, 'getPreInterviewScores']);









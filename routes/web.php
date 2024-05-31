<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CandidateController;

Route::redirect('/', '/login'); 
Route::get('/login', [UserAuthenticationController::class,'login'])->middleware('alreadyLoggedIn');
Route::post('login-user', [UserAuthenticationController::class,'loginUser'])->name('login-user');
Route::get('/usermanage/dashboard', [UserAuthenticationController::class,'dashboard'])->middleware('isLoggedIn')->name('usermanage.dashboard');
Route::get('/logout', [UserAuthenticationController::class, 'logout'])->name('logout');
Route::get('/usermanage/addjudge', [UserManagementController::class, 'addJudgeForm'])->name('addJudgeForm');
Route::post('/usermanage/addjudge', [UserManagementController::class, 'addJudge'])->name('addJudge');
Route::delete('/user/{id}', [UserManagementController::class, 'deleteUser'])->name('user.delete');
Route::put('/user/{id}', [UserManagementController::class, 'updateUser'])->middleware('isLoggedIn')->name('user.update');
Route::post('/candidate/add', [UserManagementController::class, 'addCandidate'])->middleware('isLoggedIn')->name('candidate.add');
Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidate.create');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidate.store');
Route::get('/usermanage/candidate_dash', [UserManagementController::class, 'candidateDash'])->middleware('isLoggedIn')->name('usermanage.candidate_dash');





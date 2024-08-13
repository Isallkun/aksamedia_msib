<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeAPIController;

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.token');
Route::get('/divisions', [DivisionController::class, 'index'])->middleware('auth.token');
Route::get('/employees', [EmployeeController::class, 'index'])->middleware('auth.token');
Route::post('/employees', [EmployeeAPIController::class, 'store'])->middleware('auth.token');
Route::get('/employees/{id}', [EmployeeAPIController::class, 'show'])->middleware('auth.token');
Route::post('/employees/{id}', [EmployeeAPIController::class, 'update'])->middleware('auth.token');
Route::delete('/employees/{id}', [EmployeeAPIController::class, 'destroy'])->middleware('auth.token');

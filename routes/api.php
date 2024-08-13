<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/divisions', [DivisionController::class, 'index']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);

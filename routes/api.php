<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Api\AccountsController;
use App\Http\Controllers\Api\TransactionsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('createAccount', [AccountsController::class, 'createAccount'])->middleware('auth:sanctum');
Route::post('getAccounts', [AccountsController::class, 'getAccounts'])->middleware('auth:sanctum');
Route::post('getAccountTransactions', [TransactionsController::class, 'getTransactions'])->middleware('auth:sanctum');
Route::post("login",[UserController::class,'login']);
Route::post('logout', [UserController::class, 'logout']);
Route::post("register",[UserController::class,'register']);
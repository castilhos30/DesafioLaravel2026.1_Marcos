<?php

use App\Http\Controllers\Api\CepController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/showUser', [UserController::class, 'showUser']);
Route::get('/showAdmin', [AdminController::class, 'showAdmin']);

Route::get('/showProduct', [ProductController::class, 'showProduct']);


Route::get('/cep/{cep}', [CepController::class, 'show']);
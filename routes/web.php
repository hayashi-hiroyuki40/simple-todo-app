<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[TodoController::class,'index']);
Route::post('/todos',[TodoController::class,'store']);
Route::patch('/todos/update',[TodoController::class,'update']);
Route::delete('/todos/delete',[TodoController::class,'destroy']);

Route::get('/categories',[CategoryController::class,'index']);
Route::post('/categories',[CategoryController::class,'store']);
Route::patch('/categories/update',[CategoryController::class,'update']);
Route::delete('/categories/delete',[CategoryController::class,'destroy']);

Route::get('/todos/search',[TodoController::class,'search']);
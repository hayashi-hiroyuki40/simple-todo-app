<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[TodoController::class,'index']);
Route::post('/todos',[TodoController::class,'store']);
Route::put('/todos/update',[TodoController::class,'update']);
Route::delete('/todos/delete',[TodoController::class,'destroy']);
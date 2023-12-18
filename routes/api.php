<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/create', [UserController::class, 'createUser']);
Route::get('/user/import/{id}', [UserController::class, 'importUser']);

Route::post('/task/create', [TaskController::class, 'createTask']);
Route::get('/task/{id}', [TaskController::class, 'getTask']);
Route::post('/task/update', [TaskController::class, 'updateTask']);
Route::delete ('/task/delete/{id}', [TaskController::class, 'deleteTask']);
Route::get('/task/changeStatus/{id}', [TaskController::class, 'changeStatus']);

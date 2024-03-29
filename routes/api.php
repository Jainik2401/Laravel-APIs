<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('student', [StudentController::class, 'index']);
Route::get('student/{id}', [StudentController::class, 'show']);
Route::get('students/{name}', [StudentController::class, 'search']);
Route::post('student', [StudentController::class, 'store']);
Route::put('student/{id}', [StudentController::class, 'update']);
Route::delete('student/{id}', [StudentController::class, 'destroy']);


Route::get('players', [PlayerController::class, 'index']);
Route::get('player/{id}', [PlayerController::class, 'show']);
Route::get('players/{name}', [PlayerController::class, 'search']);
Route::post('players', [PlayerController::class, 'store']);
Route::put('players/{id}', [PlayerController::class, 'update']);
Route::delete('players/{id}', [PlayerController::class, 'destroy']);


Route::post('file', [FileController::class, 'upload']);



// Route::group(['middleware' => 'auth:sanctum'], function () {
//     Route::get('employee', [EmployeeController::class, 'index']);
//     Route::get('employee/{id}', [EmployeeController::class, 'show']);
//     Route::get('employees/{name}', [EmployeeController::class, 'search']);
//     Route::post('employee', [EmployeeController::class, 'store']);
//     Route::put('employee/{id}', [EmployeeController::class, 'update']);
//     Route::delete('employee/{id}', [EmployeeController::class, 'destroy']);
// });


// Route::post("login", [UserController::class, 'index']);
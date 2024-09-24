<?php

use App\Http\Controllers\MyToDoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', [MyToDoListController::class, 'index']);
Route::post('/todos', [MyToDoListController::class, 'store']);
Route::put('/todos/{id}', [MyToDoListController::class, 'update']);
Route::delete('/todos/{id}', [MyToDoListController::class, 'destroy']);
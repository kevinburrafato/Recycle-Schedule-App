<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecycleController;
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

// Public routes
Route::get('recycles/today/', [RecycleController::class, 'today']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/recycles', [RecycleController::class, 'index']);
Route::get('/recycles/{id}', [RecycleController::class, 'show']);
Route::get('/recycles/{name}', [RecycleController::class, 'search']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/recycles', [RecycleController::class, 'store']);
    Route::put('/recycles/{id}', [RecycleController::class, 'update']);
    Route::delete('/recycles/{id}', [RecycleController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




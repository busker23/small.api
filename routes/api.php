<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\ManagerResponseController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/requests', [UserRequestController::class, 'index']);
    Route::post('/request', [UserRequestController::class, 'create']);
    Route::get('/requests_manager', [ManagerResponseController::class, 'getAllRequests']);
    Route::get('/requests_option', [ManagerResponseController::class, 'getOptionalRequests']);
    Route::post('/response', [ManagerResponseController::class, 'create']);
});

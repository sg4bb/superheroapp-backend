<?php

use App\Http\Controllers\API\AuthController;
use App\Models\SuperHero;
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


Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::get('superheros', [\App\Http\Controllers\SuperHeroController::class, 'showAll']);
Route::get('superheros/{id}', [\App\Http\Controllers\SuperHeroController::class, 'show']);
Route::post('superheros/create', [\App\Http\Controllers\SuperHeroController::class, 'create']);
Route::put('superheros/update/{id}', [\App\Http\Controllers\SuperHeroController::class, 'update']);
Route::delete('superheros/delete/{id}', [\App\Http\Controllers\SuperHeroController::class, 'destroy']);



Route::middleware('auth:sanctum')->group(function () {


    Route::get('users/{id}', [\App\Http\Controllers\API\UserController::class, 'show']);
    Route::put('users/{id}', [\App\Http\Controllers\API\UserController::class, 'update']);

    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::get('inside-mware', function () {
        return response()->json('Success', 200);
    });
});

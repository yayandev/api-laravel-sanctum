<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'Logout']);
    Route::post('/posts', [PostController::class, 'create']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
});
Route::get('/posts', [PostController::class, 'showall']);
Route::get('/posts/{id}', [PostController::class, 'showDetail']);
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);

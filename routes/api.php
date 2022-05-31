<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RecipeController;
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

/* Public route */
Route::get('access-token', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
/* Private route */
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'currentUser']);
    Route::put('me', [AuthController::class, 'updateUser']);
    Route::put('me/change-password', [AuthController::class, 'changePassword']);
    Route::post('me/upload-avatar', [AuthController::class, 'uploadAvatar']);
    Route::apiResources([
        'home'     => HomeController::class,
        'category' => CategoryController::class,
        'recipe'   => RecipeController::class,
        'post'     => PostController::class
    ]);
});
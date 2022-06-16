<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\UserController;
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
    Route::post('me/like', [UserController::class, 'like'])->name('user.like');
    Route::get('me/likes', [UserController::class, 'likes'])->name('user.likes');
    Route::apiResources([
        'category' => CategoryController::class,
        'post'     => PostController::class
    ]);
    Route::group(['prefix' => 'home'], function (){
        Route::get('/', [HomeController::class, 'index'])->name('home.index');
        Route::get('recipe-ideas', [HomeController::class, 'getRecipeIdeas'])->name('home.recipe.ideas');
        Route::get('category-ideas', [HomeController::class, 'getCategoryIdeas'])->name('home.category.ideas');
        Route::get('featured-article', [HomeController::class, 'getFeaturedArticles'])->name('home.post.feature');
    });

    Route::group(['prefix' => 'recipe'], function () {
        Route::get('/', [RecipeController::class, 'index']);
        Route::get('recipe-by-category', [RecipeController::class, 'getRecipeByCategory']);
        Route::get('/{recipe}', [RecipeController::class, 'show']);
    });
});
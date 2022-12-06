<?php

use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\DetailController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\ContactUsController;

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

Route::post('login', [UserController::class, 'login']);

Route::get('movie', [MovieController::class, 'movie']);

Route::get('recommend/{id}', [MovieController::class, 'recommend']);

Route::get('recommendDetail/{moviename}', [DetailController::class, 'recdetail']);

Route::get('categories/{typename}', [CategoriesController::class, 'categories']);

Route::get('categoriesMovie/{typename}', [CategoriesController::class, 'categoriesMovie']);

Route::get('type', [CategoriesController::class, 'type']);

Route::get('like/{mid}', [LikeController::class, 'like']);

Route::post('register', [UserController::class, 'register']);

Route::get('profile/{id}', [UserController::class, 'profile']);

Route::get('search/{searchName}', [SearchController::class, 'search']);

Route::post('update', [UserController::class, 'update']);

Route::post('index', [ProductController::class, 'index']);

Route::get('detail/{id}/{uid}', [DetailController::class, 'detail']);

Route::get('showcommentall/{id}/{uid}', [DetailController::class, 'showcommentall']);

Route::get('showcommentMe/{id}/{uid}', [DetailController::class, 'showcommentMe']);

Route::post('addComment', [CommentController::class, 'addComment']);

Route::post('contact', [ContactUsController::class, 'contact']);

Route::post('addFilling', [LikeController::class, 'addFilling']);

Route::post('editFilling', [LikeController::class, 'editFilling']);

Route::get('deleteComment/{id}', [CommentController::class, 'deleteComment']);
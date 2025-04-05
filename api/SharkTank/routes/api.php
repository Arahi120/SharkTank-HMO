<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LabelController;
use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;



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

Route::middleware('auth:sanctum')->get('/user', 
    function (Request $request) {
    return $request->user();
});

Route::get('/labels', [LabelController::class, 'list']);
Route::get('/labels/{id}', [LabelController::class, 'item']);
Route::post('/labels', [LabelController::class, 'create']);
Route::put('/labels/{id}', [LabelController::class, 'update']);
Route::delete('/labels/{id}', [LabelController::class, 'delete'])->name('label.delete');

Route::get('/investors', [InvestorController::class, 'list']);
Route::get('/investors/{id}', [InvestorController::class, 'item']);
Route::post('/investors', [InvestorController::class, 'create']);
Route::put('/investors/{id}', [InvestorController::class, 'update']);
Route::delete('/investors/{id}', [InvestorController::class, 'delete'])->name('investor.delete');

Route::get('/comments', [CommentController::class, 'list']);
Route::get('/comments/{id}', [CommentController::class, 'item']);
Route::post('/comments', [CommentController::class, 'create']);
Route::put('/comments/{id}', [CommentController::class, 'update']);
Route::delete('/comments/{id}', [CommentController::class, 'delete'])->name('comment.delete');

// posts de users
Route::get('/posts/users', [PostController::class, 'posts_users']);
Route::get('/posts', [PostController::class, 'list']);         // Listar todos los posts
Route::get('/posts/{id}', [PostController::class, 'item']);   // Obtener un post por ID
Route::post('/posts', [PostController::class, 'create']);     // Crear un post
Route::put('/posts/{id}', [PostController::class, 'update']); // Actualizar un post
Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('post.delete');

Route::get('/offers', [OfferController::class, 'list']);
Route::get('/offers/{id}', [OfferController::class, 'item']);
Route::post('/offers', [OfferController::class, 'create']);
Route::put('/offers/{id}', [OfferController::class, 'update']);
Route::delete('/offers/{id}', [OfferController::class, 'delete'])->name('offer.delete');

Route::get('/users', [UserController::class, 'list']);
Route::get('/users/profile/{id}', [UserController::class, 'userprofile']);
Route::post('/users/updateprofile', [UserController::class, 'updateUserProfile']);
Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users', [UserController::class, 'create']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/userprofile', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);


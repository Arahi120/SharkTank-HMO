<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LabelController;
use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;


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
Route::post('/labels/create', [LabelController::class, 'create']);
Route::post('/labels/{id}/update', [LabelController::class, 'update']);

Route::get('/investors', [InvestorController::class, 'list']);
Route::get('/investors/{id}', [InvestorController::class, 'item']);
Route::post('/investors/create', [InvestorController::class, 'create']);
Route::post('/investors/{id}/update', [InvestorController::class, 'update']);

Route::get('/comments', [CommentController::class, 'list']);
Route::get('/comments/{id}', [CommentController::class, 'item']);
Route::post('/comments/create', [CommentController::class, 'create']);
Route::post('/comments/{id}/update', [CommentController::class, 'update']);

Route::get('/posts', [PostController::class, 'list']);
Route::get('/posts/{id}', [PostController::class, 'item']);
Route::post('/posts/create', [PostController::class, 'create']);
Route::post('/posts/{id}/update', [PostController::class, 'update']);

Route::get('/offers', [OfferController::class, 'list']);
Route::get('/offers/{id}', [OfferController::class, 'item']);
Route::post('/offers/create', [OfferController::class, 'create']);
Route::post('/offers/{id}/update', [OfferController::class, 'update']);

Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users/create', [UserController::class, 'create']);
Route::post('/users/{id}/update', [UserController::class, 'update']);
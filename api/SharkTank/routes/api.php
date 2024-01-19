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

Route::get('/investors', [InvestorController::class, 'list']);
Route::get('/investors/{id}', [InvestorController::class, 'item']);

Route::get('/comments', [CommentController::class, 'list']);
Route::get('/comments/{id}', [CommentController::class, 'item']);

Route::get('/posts', [PostController::class, 'list']);
Route::get('/posts/{id}', [PostController::class, 'item']);

Route::get('/offers', [OfferController::class, 'list']);
Route::get('/offers/{id}', [OfferController::class, 'item']);

Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'item']);
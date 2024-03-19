<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/admin',[AdminController::class,'index'])->name('dashboard');
Route::get('/admin/comment',[CommentController::class,'index'])->name('comment.index');
Route::get('/admin/investor',[InvestorController::class,'index'])->name('investor.index');
Route::get('/admin/label',[LabelController::class,'index'])->name('label.index');
Route::get('/admin/offer',[OfferController::class,'index'])->name('offer.index');
Route::get('/admin/post',[PostController::class,'index'])->name('post.index');
Route::get('/admin/user',[UserController::class,'index'])->name('user.index');

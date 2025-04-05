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
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/admin/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/admin/user/store', [UserController::class, 'add'])->name('user.add');
Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('user.show');


Route::get('/admin/post', [PostController::class, 'index'])->name('post.index');
Route::get('/admin/post/create', [PostController::class, 'create'])->name('post.create'); // ✅ Agregada
Route::post('/admin/post/store', [PostController::class, 'add'])->name('post.add');
Route::get('/admin/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/admin/post/{id}/update', [PostController::class, 'update'])->name('post.update');
Route::delete('/admin/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
Route::get('/admin/post/{id}', [PostController::class, 'show'])->name('post.show');


Route::get('/admin/comment', [CommentController::class, 'index'])->name('comment.index');
Route::get('/admin/comment/{id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
Route::put('/admin/comment/{id}/update', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/admin/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
Route::post('/admin/comment/store', [CommentController::class, 'create'])->name('comment.add');

Route::get('/admin/investor', [InvestorController::class, 'index'])->name('investor.index');
Route::get('/admin/investor/{id}/edit', [InvestorController::class, 'edit'])->name('investor.edit');
Route::put('/admin/investor/{id}/update', [InvestorController::class, 'update'])->name('investor.update');
Route::delete('/admin/investor/{id}', [InvestorController::class, 'destroy'])->name('investor.destroy');
Route::post('/admin/investor/store', [InvestorController::class, 'create'])->name('investor.add');

Route::get('/admin/label', [LabelController::class, 'index'])->name('label.index');
Route::get('/admin/label/{id}/edit', [LabelController::class, 'edit'])->name('label.edit');
Route::put('/admin/label/{id}/update', [LabelController::class, 'update'])->name('label.update');
Route::delete('/admin/label/{id}', [LabelController::class, 'destroy'])->name('label.destroy');
Route::post('/admin/label/store', [LabelController::class, 'store'])->name('label.add');

Route::get('/admin/offer', [OfferController::class, 'index'])->name('offer.index');
Route::get('/admin/offer/{id}/edit', [OfferController::class, 'edit'])->name('offer.edit');
Route::put('/admin/offer/{id}/update', [OfferController::class, 'update'])->name('offer.update');
Route::delete('/admin/offer/{id}', [OfferController::class, 'destroy'])->name('offer.destroy');
Route::post('/admin/offer/store', [OfferController::class, 'add'])->name('offer.add');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



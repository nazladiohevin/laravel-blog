<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\AdminCategoryController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardPostController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
// si slug langsung connect ke table post column slug, maka dari itu
// namanya harus sama
Route::get("/posts/{post:slug}", [PostController::class, 'content']);
Route::get("/categories", [CategoryController::class, 'index']);
Route::get("/categories/{category:slug}", [CategoryController::class, 'content']);
Route::get("/author", [UserController::class, 'index']);
Route::get("/author/{author:username}", [UserController::class, 'author_post']);

// Middleware 'guest' menjadikan halaman tidak bisa diakses ketika 
// user sudah login
// Route (/segment/dst) bisa dikasih nama pake ->name()
Route::get('/login', [LoginController::class, 'index'])
  ->name('login')
  ->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'index'])
  ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index'])
  ->middleware('auth');

Route::get('/dashboard/posts/createSlug', [DashboardPostController::class, 'createSlug'])
  ->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)
  ->middleware('auth');

// Except berarti resource nya jalan tanpa link show
// memberikan nama admin pada middleware sesuai yang telah didaftarkan pada Kernel.php
Route::get('/dashboard/categories/createSlug', [AdminCategoryController::class, 'createSlug'])->middleware('admin');
Route::resource('/dashboard/categories', AdminCategoryController::class)
  ->except('show')
  ->middleware('admin');

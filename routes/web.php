<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use GuzzleHttp\Middleware;

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

Route::resource('product', ProductController::class)->middleware('auth');
Route::resource('category', CategoryController::class);
Route::resource('admin', AdminController::class)->middleware('auth');
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'login_post'])->name('login_post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [AdminController::class, 'register'])->name('register');
Route::post('register', [AdminController::class, 'register_post'])->name('register_post');

Route::get('test', [LoginController::class, 'testquantity'])->name('test');
Route::post('test', [LoginController::class, 'testquantity_post'])->name('test_post');

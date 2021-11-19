<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CharengeController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy']);
    // ->middleware('auth:users');

Route::resource('posts', PostController::class)
    ->only(['show', 'index']);

Route::resource('charenges', CharengeController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy']);

Route::resource('charenges', CharengeController::class)
    ->only(['show', 'index']);

Route::resource('charenges.entries', EntryController::class)
    ->only(['store', 'destroy']);

Route::resource('charenges.comments', CommentController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy']);
// ->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CharengeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// charenge
Route::group(['middleware' => ['api']], function(){
    Route::apiResource('charenges', App\Http\Controllers\Api\CharengeController::class);
});

// post
Route::group(['middleware' => ['api']], function () {
    Route::apiResource('posts', App\Http\Controllers\Api\PostController::class);
});

// comment
Route::group(['middleware' => ['api']], function () {
    Route::apiResource('posts.comments', App\Http\Controllers\Api\CommentController::class);
});

// ユーザー登録
Route::post('/register', [RegisterController::class, 'register']);

// ログイン
Route::post('/login', [LoginController::class, 'login']);



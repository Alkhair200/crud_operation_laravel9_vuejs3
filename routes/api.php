<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::apiResource('posts' ,App\Http\Controllers\PostController::class);
Route::post('createPost' ,[App\Http\Controllers\PostController::class,'createPost'])->name('createPost');
Route::get('getPost' ,[App\Http\Controllers\PostController::class,'getPost'])->name('getPost');

Route::put('updatePost/{id}' ,[App\Http\Controllers\PostController::class,'updatePost'])->name('updatePost');

Route::delete('deletePost/{id}' ,[App\Http\Controllers\PostController::class,'deletePost'])->name('deletePost');



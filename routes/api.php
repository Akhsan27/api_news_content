<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Middleware\accounting;

Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('/logout',[AuthenticationController::class,'logout']);
    Route::get('/me',[AuthenticationController::class,'me']);
    Route::post('/post',[PostController::class,'store']);
    Route::patch('/post/{id}',[PostController::class,'update'])->middleware('Accounting');
    Route::delete('/delete/{id}',[PostController::class,'destroy'])->middleware('Accounting');
});


Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{id}',[PostController::class,'show']);
Route::post('/login',[AuthenticationController::class,'login']);
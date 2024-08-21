<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CVController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PasswordResetRequestController;
use App\Http\Controllers\Api\ResetPasswordController;

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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('posts/{id?}',[PostController::class,'index']);
Route::get('articles/{id?}',[ArticleController::class,'index']);
Route::get('comments/{id?}',[CommentController::class,'index']);

Route::middleware('auth:sanctum')->group(function (){  
    Route::post('/logout', [AuthController::class, 'logout']);
    ////////////////////Post//////////////////
    Route::controller(PostController::class)->group(function () {
        Route::post('post', 'store');
        Route::get('post', 'show');
        Route::put('post/{post}', 'update');
        Route::delete('post/{post}', 'destroy');
    });
   ////////////////////Article//////////////////
    Route::controller(ArticleController::class)->group(function () {
        Route::post('article', 'store');
        Route::get('article', 'show');
        Route::post('article/{article}', 'update');
        Route::delete('article/{article}', 'destroy');
    });
   ////////////////////Comment//////////////////
    Route::controller(CommentController::class)->group(function () {
        Route::post('comment', 'store');
        Route::get('comment', 'show');
        Route::put('comment/{comment}', 'update');
        Route::delete('comment/{comment}', 'destroy');
    });
    //////////////////C_V_S////////////////////
    Route::controller(CVController::class)->group(function (){
        Route::get('get-cvs/{id?}','index');
        Route::post('cvs', 'store');
        Route::delete('cv/{id}', 'destroy');
    });
});
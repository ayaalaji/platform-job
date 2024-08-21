<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CVController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('admin/post',PostController::class);
    Route::resource('admin/article',ArticleController::class);
    Route::resource('admin/comment',CommentController::class);
    

    //Soft Delete Company
    Route::post('companies/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
    Route::delete('companies/{id}/forceDelete', [CompanyController::class, 'forceDelete'])->name('companies.forceDelete');
    //Soft Delete Post
    Route::post('admin/post/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('admin/post/{id}/forceDelete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    //Soft Delete Article
    Route::post('admin/article/{id}/restore', [ArticleController::class, 'restore'])->name('articles.restore');
    Route::delete('admin/article/{id}/forceDelete', [ArticleController::class, 'forceDelete'])->name('articles.forceDelete');
    

});
Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin/cvs', [CVController::class, 'index'])->name('admin.cvs.index');
    Route::get('/view/{id}', [CVController::class, 'view'])->name('view.pdf');
});

/////////////////////////Forget password////////////
   

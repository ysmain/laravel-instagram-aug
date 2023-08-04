<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;


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

Auth::routes();

Route::group(["middleware"=>"auth"],function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/suggested', [HomeController::class, 'suggested'])->name('suggested');
    Route::get('/explore/search', [HomeController::class,'search'])->name('explore.search');
    Route::resource('/posts', PostController::class);

    Route::resource('/comments', CommentController::class);
    Route::resource('/profile', ProfileController::class);
    Route::resource('like', LikeController::class);
    Route::resource('follow', FollowController::class);
    Route::get('/profile/{id}/followers', [ProfileController::class,'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following', [ProfileController::class,'following'])->name('profile.following');

    Route::group(["prefix"=>"admin/","as" => "admin."], function(){

    Route::get("/users", [UsersController::class,'index'])->name('users.index');
    Route::get("/posts", [PostsController::class,'index'])->name('posts.index');
    Route::get("/categories", [CategoriesController::class,'index'])->name('categories.index');
    Route::post("/categories/store", [CategoriesController::class,'store'])->name('categories.store');
    Route::delete("/users/{id}/deactivate", [UsersController::class,'deactivate'])->name('users.deactivate');
    Route::delete("/posts/{id}/deactivate", [PostsController::class,'deactivate'])->name('posts.deactivate');
    Route::delete("/categories/{id}/destroy", [CategoriesController::class,'destroy'])->name('categories.destroy');
    Route::patch("/users/{id}/activate", [UsersController::class,'activate'])->name('users.activate');
    Route::patch("/posts/{id}/activate", [PostsController::class,'activate'])->name('posts.activate');
    Route::patch("/posts/{id}/update", [CategoriesController::class,'update'])->name('categories.update');

    Route::get('/users/search', [UsersController::class,'search'])->name('users.search');
    Route::get('/posts/search', [PostsController::class,'search'])->name('posts.search');
    Route::get('/categories/search', [CategoriesController::class,'search'])->name('categories.search');

    });
});

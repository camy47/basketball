<?php

use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BasketballController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Blog Routes
Route::get('/', function () {
    return view('posts', [
        'posts' => \App\Models\Post::latest()->get()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post,
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts,
    ]);
});

// Shop Routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile', [
            'user' => auth()->user()->load('posts')
        ]);
    })->middleware('auth')->name('profile');
});


Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::post('/basketballs', [BasketballController::class, 'store'])->name('basketballs.store');
Route::put('/basketballs/{basketball}', [BasketballController::class, 'update'])->name('basketballs.update');
Route::delete('/basketballs/{basketball}', [BasketballController::class, 'destroy'])->name('basketballs.destroy');

Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy')->middleware('admin');

Route::get('/products/{id}/quick-view', [ProductController::class, 'quickView']);

Route::get('/news', [NewsController::class, 'index'])->name('news');


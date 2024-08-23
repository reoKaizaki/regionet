<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(["middleware" => ["auth"]], function() {

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show']);

});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::post('/users/change-password', [UserController::class, 'changePassword']);
});

Route::middleware('auth')->group(function () {
    Route::get('user/edit', [UserController::class, 'edit']);
    Route::post('user/update', [UserController::class, 'update']);
});

Route::middleware('auth')->group(function () {
    Route::post('follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::post('unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');
});

//コメント
Route::middleware('auth')->group(function () {
    Route::get('/posts/{post}/comments/create', [CommentController::class, 'create']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::get('posts/{comment_id}', [CommentController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::post('posts/{post}/like', [LikeController::class, 'toggle'])->name('likes.toggle');
});

Route::middleware('auth')->group(function () {
    Route::post('posts/{post}/tags', [TagController::class, 'store'])->name('tags.store');
});

require __DIR__.'/auth.php';

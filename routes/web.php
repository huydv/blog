<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    \Illuminate\Support\Facades\DB::listen(function($query) {
        logger($query->sql, $query->bindings);
    });
    return view('posts', [
        'posts' => Post::latest('published_at')->get(),
        'categories' => Category::all()
    ]);
})->name('home');

Route::get('posts/{post}', function(Post $post) {
    return view('post', [
        'post' => $post,
        'categories' => Category::all()
    ]);
})->name('post');

Route::get('categories/{category}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts,
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('category');

Route::get('authors/{author}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts,
        'categories' => Category::all()
    ]);
});

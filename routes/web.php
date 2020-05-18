<?php

use App\Category;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
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

    $featured = Post::orderBy('created_at', 'DESC')->take(3)->get();

    $posts = Post::paginate(12);

    return view('frontend.welcome', compact('featured', 'posts'));
});


Route::get('/post/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->first();
    $previous = Post::where('id', '<', $post->id)->first();
    $next = Post::where('id', '>', $post->id)->first();

    return view('frontend.post', compact('post', 'previous', 'next'));
})->name('post.slug');


Route::get('/category/{slug}', function ($slug) {
    $category = Category::where('slug', $slug)->first();
    $posts = $category->posts()->paginate(12);
    return view('frontend.category', compact('category', 'posts'));
})->name('category.slug');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:Administrator']], function () {
    Route::resource('/user', 'AdminUsersController');
});

Route::group(['middleware' => ['role:Author|Administrator']], function () {
    Route::resource('/posts', 'AdminPostsController');
    Route::get('/media-manager', function () {
        return view('admin.media.index');
    });
    Route::get('/dashboard', function () {
        return view('admin.index');
    });
    ctf0\MediaManager\MediaRoutes::routes();
});

Route::group(['middleware' => ['role:Administrator']], function () {
    Route::resource('/categories', 'AdminCategoriesController');
});

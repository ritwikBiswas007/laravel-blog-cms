<?php

use App\Post;
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
    return view('welcome');
});

// // MediaManager
// ctf0\MediaManager\MediaRoutes::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





Route::group(['middleware' => 'admin'], function () {

    Route::resource('/admin/user', 'AdminUsersController');
    Route::resource('/admin/posts', 'AdminPostsController');
    Route::resource('/admin/categories', 'AdminCategoriesController');
    Route::get('/admin/media', function () {
        return view('admin.media.index');
    });
    Route::get('/admin', function () {
        return view('admin.index');
    });
    ctf0\MediaManager\MediaRoutes::routes();
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Web routes for your application loaded by the RouteServiceProvider -
| assigned to the "web" middleware group.
|
*/

Route::resource('posts', PostController::class);

Route::get('/', function () {
    $latestPost = Post::latest()->first();
    return view('welcome', compact('latestPost'));
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/team', function () {
    return view('team');
});

Route::get('/blog', function () {
    $latestPost = Post::latest()->first();
    return view('blog', compact('latestPost'));
});

Route::get('/contact', function () {
    return view('contact');
});


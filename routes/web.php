<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Controllers\ContactController;



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
})->name('home');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/team', function () {
    return view('team');
})->name('team');

Route::get('/blog', [PostController::class, 'index'])->name('blog');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::post('/contact', [ContactController::class, 'submit']
)->name('contact.submit');


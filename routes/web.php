<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Web routes for your application loaded by the RouteServiceProvider -
| assigned to the "web" middleware group.
|
*/


/* Blog post reroutes */

Route::redirect('/undefined-behavior', '/posts/undefined-behavior');
// Synonym route


Route::resource('posts', PostController::class);

/* Home page + capacity to display most recent blog post */

Route::get('/', function () {
    $latestPost = Post::latest()->first();
    return view('welcome', compact('latestPost'));
})->name('home');

/* Main pages */

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

/* Login and form handling */

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::post('/contact', [ContactController::class, 'submit']
)->name('contact.submit');

Route::post('/login', [AuthController::class, 'login']
)->name('auth.login');



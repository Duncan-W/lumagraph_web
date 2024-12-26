<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SitemapController; 



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Web routes for your application loaded by the RouteServiceProvider -
| assigned to the "web" middleware group.
|
*/

/* Sitemap generator */

Route::get('/sitemap.xml', [SitemapController::class, 'index']);


/* Google console reroutes */

Route::redirect('/undefined-behavior', '/posts/undefined-behavior');
Route::redirect('/public/posts/1', '/posts/undefined-behavior');
Route::redirect('/index.php/feed', '/blog');
Route::redirect('/about', '/products');




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


// Static route (catch-all) for Russell product pages in public
Route::get('/{page}', function ($page) {
    // Build the path to the static file
    $path = public_path("static/{$page}.html");

    // Check if the file exists
    if (file_exists($path)) {
        return response()->file($path);
    }

    abort(404);
})->where('page', '[a-zA-Z0-9_-]+');



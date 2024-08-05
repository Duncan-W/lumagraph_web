<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Web routes for your application loaded by the RouteServiceProvider -
| assigned to the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('products');
});

Route::get('/about', function () {
    return view('team');
});

Route::get('/about', function () {
    return view('blog');
});

Route::get('/about', function () {
    return view('contact');
});


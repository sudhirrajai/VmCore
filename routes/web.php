<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/service-details', function () {
    return view('service-details');
})->name('service-details');

Route::get('/team', function () {
    return view('team');
})->name('team');

Route::get('/team-details', function () {
    return view('team-details');
})->name('team-details');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

Route::get('/portfolio-details', function () {
    return view('portfolio-details');
})->name('portfolio-details');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/blog-details', function () {
    return view('blog-details');
})->name('blog-details');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/error', function () {
    return view('error');
})->name('error');



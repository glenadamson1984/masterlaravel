<?php

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
    return 'home page';
})->name('home.index');

Route::get('/contact', function () {
    return 'Contact';
})->name('home.contact');

// parameters are passed to the function in the order in which they are provided so names can be anything
// but typically they should be the same name as the input parameter for best practice
// i.e the below could be
// Route::get('/posts/{id}', function($BlogPostID) {
Route::get('/posts/{id}', function($id) {
    return 'Blog Post ' . $id;
})->name('posts.show');

// optional parameter must then have a default set in the function
Route::get('recent-posts/{days_ago?}', function($daysAgo = 20) {
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index');

// constraining route parameters - must be of certain type or length etc - done by adding where clause and using
// regular expressions against each parameter
Route::get('constraint/{id}', function($id) {
    return 'Constraint ' . $id;
});
    // adding the below where clause would apply this to this route, however to apply to all routes see app/Providers
    // /RouteServiceProvider where i added the below so its used by all
    // ->where(['id' => '[0-9]+']);




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

// this is more verbose syntax but here we are not actually passing any data so we can simplify this
//Route::get('/', function () {
//    return view('home.index', []);
//})->name('home.index');

// to this
Route::view('/', 'home.index')->name('home.index');

Route::get('/contact', function () {
    return view('home.contact', []);
})->name('home.contact');

// parameters are passed to the function in the order in which they are provided so names can be anything
// but typically they should be the same name as the input parameter for best practice
// i.e the below could be
// Route::get('/posts/{id}', function($BlogPostID) {
Route::get('/post/{id}', function($id) {
    return 'Blog Post ' . $id;
})->name('post.show');

//passing and rendering data in a view, also see view for blade directive conditionals
Route::get('/posts/{id}', function($id) {
    $posts = [
        1 => [
            'title' => 'intro to laravel',
            'content' => 'short intro to laravel',
            'is_new' => true
        ],
        2 => [
            'title' => 'intro to php',
            'content' => 'short intro to php',
            'is_new' => false
        ]
    ];

    // this will work if we provide an id of 1 or 2 but anything other number will throw an
    // unexpected error so we can use abortif and handle the error better
    // here we check if the array at the index is not set then throw a 404
    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
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




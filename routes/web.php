<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
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
//Route::view('/', 'home.index')->name('home.index');
//
//Route::get('/contact', function () {
//    return view('home.contact', []);
//})->name('home.contact');


//we can also move these routes to a controller
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

// if controller only have a single action you do not need to pass an array of actions
Route::get('/single', AboutController::class);

// use a PostsController as a resource will bind all possible routes but we can specify the specific ones
// we want using the only method, can also use except for the inverse
Route::resource('posts', PostsController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update']);

// parameters are passed to the function in the order in which they are provided so names can be anything
// but typically they should be the same name as the input parameter for best practice
// i.e the below could be
// Route::get('/posts/{id}', function($BlogPostID) {
//Route::get('/post/{id}', function($id) {
//    return 'Blog Post ' . $id;
//})->name('post.show');


$posts = [
    1 => [
        'title' => 'intro to laravel',
        'content' => 'short intro to laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'intro to php',
        'content' => 'short intro to php',
        'is_new' => false
    ]
];

//passing and rendering data in a view, also see view for blade directive conditionals
// also to make use of a variable declared outside the anonymous function we need to
// use the use keyword
//Route::get('/posts/{id}', function($id) use ($posts) {
//
//    // this will work if we provide an id of 1 or 2 but anything other number will throw an
//    // unexpected error so we can use abortif and handle the error better
//    // here we check if the array at the index is not set then throw a 404
//    abort_if(!isset($posts[$id]), 404);
//
//    return view('posts.show', ['post' => $posts[$id]]);
//})->name('posts.show');

//if we plan and using query paramaters like /posts/1?page=1&limit=5 you can
//achieve this by using request all method or being more specic request query
//Route::get('/posts', function() use ($posts) {
////    not using this for now but used as an example
//    (int)request()->query('page', 1);
//
//    return view('posts.index', ['posts' => $posts]);
//})->name('posts.index');

// optional parameter must then have a default set in the function
// can apply middleware easily, for all pre-configured middleware look in app/http/kernal then
// we can apply it by using middleware method
Route::get('recent-posts/{days_ago?}', function($daysAgo = 20) {
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index')->middleware('guest');

// constraining route parameters - must be of certain type or length etc - done by adding where clause and using
// regular expressions against each parameter
Route::get('constraint/{id}', function($id) {
    return 'Constraint ' . $id;
});
    // adding the below where clause would apply this to this route, however to apply to all routes see app/Providers
    // /RouteServiceProvider where i added the below so its used by all
    // ->where(['id' => '[0-9]+']);

// can also return http responses which is useful when you need to return extra detail like
// a certain header etc - note response also has a view method which can be chained
// response()->view()
Route::get('/fun/responses', function() use($posts) {
    return response($posts, 201)
        ->header('Content-Type', 'application/json')
        ->cookie('MY_COOKIE', 'Glen Adamson', 3600);
});

// we can group route together if they share a common prefix, name or middleware
Route::prefix('/fun')->name('fun.')->group(function () use($posts) {
    // can do a redirect with a route to do something but then redirect to another route
    Route::get('/redirect', function() {
        return redirect('/contact');
    })->name('redirect');

//back will redirect back to the last page
    Route::get('/back', function() {
        return back();
    })->name('back');

//using a named route
    Route::get('/named-route', function() {
        return redirect()->route('posts.show', ['id' => 1]);
    })->name('named-route');

//away will redirect to another webpage outside the app = external link
    Route::get('/away', function() {
        return redirect()->away('http://google.com');
    })->name('away');

//return a pure json response
    Route::get('/json', function() use($posts) {
        return response()->json($posts);
    })->name('json');

//return a file download
    Route::get('/download', function() use($posts) {
        return response()->download(public_path('/fake.jpeg'), 'face.jpeg');
    })->name('download');
});






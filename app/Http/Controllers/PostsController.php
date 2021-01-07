<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $posts = [
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        // we can have rules in the controller method itself like the below and simply
        // pass the request option above as a parameter but for more complex rules its
        // best practice to do php artisan make:request StorePost and add rules there
//        $request->validate([
//            'title' => 'bail|required|min:5|max:100',
//            'content' => 'required|min:10'
//        ]);

        $validated = $request->validated();

        // as we are using are own request we don't use the input variables from the request object
        // but rather those which have been validated so change this

//        $post = new BlogPost();
//        $post->title = $request->input('title');
//        $post->content = $request->input('content');
//        $post->save();

        // to this
//        $post = new BlogPost();
//        $post->title = $validated['title'];
//        $post->content = $validated['content'];
//        $post->save();

        //also if we modify our BlogPost model and add protected fillable this essentially
        // turns on mass assignment for one or more columns of data so we can make it
        // simpler by doing this
        $post = BlogPost::create($validated);

        //flash session variables - see app.blade.php for reading from this session
        $request->session()->flash('status', 'this blog was created');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
//        abort_if(!isset($this->posts[$id]), 404);

        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validated = $request->validated();

        $post->fill($validated);
        $post->save();

        $request->session()->flash('status', 'Blog post was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        session()->flash('staus', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
       $posts = Post::all();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {

        return view('blog-post', ['post'=> $post]);

    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $inputs = request()->validate([
            'title'=> 'required',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        // return view('admin.posts.create');
        //dd(request()->all());
    }

    public function edit()
    {
        # code...
    }
}

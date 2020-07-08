<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    // 🎣 GET ALL THE POST FUNCTION
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    // 🎣 RENDER THE create PAGE
    public function create() {
        return view('posts.create');
    }

    // 🎯 CREATE NEW POST FUNCTION
    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'New post created successfly');
    }

    // 🎣 GET A SINGLE POST BY $id
    public function show($id) {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    // 🎣 RENDER THE edit PAGE WITH THE $post DATA 
    public function edit($id) {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    // 🎯 UPDATE POST FUNCTION
    public function update(Request $request, $id) {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
            
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post updated successfly');

    }

    // 🎯 DELETE POST BY $id
    public function destroy($id) {
        
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted successfly');

    }
}

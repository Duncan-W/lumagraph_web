<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * How to handle the home page (display most recent blog post).
     */
    public function home()
    {
        $latestPost = Post::latest()->first(); // Fetch the most recent post
        return view('home', compact('latestPost')); // Pass the post to the 'home' view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|unique:posts,id', // Ensure the ID is a unique string
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id); // Fetch the post by its ID
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id); // Fetch the post by its ID
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}

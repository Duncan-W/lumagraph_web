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
        // Order posts by created_at in descending order (most recent first)
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
    
        return view('posts.index', compact('posts'));
    }
    

    /**
     * Handle the home page (display most recent blog post).
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
        // Validate the request data
        $request->validate([
            'id' => 'required|string|unique:posts,id', // URL version of title
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,avif,heif|max:20480', // Validate image file
        ]);
    
        // Process the body field
        $processedBody = str_replace('\`\`\`', '```', $request->input('body'));
    
        // Handle the image upload
        $imageName = null; // Default to null if no image is uploaded
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName(); // Get the original filename
            $imageFile->storeAs('images/blog', $imageName, 'public'); // Save the image in the specified directory with the original filename
        }
    
        // Create the post
        Post::create([
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'body' => $processedBody,
            'image' => $imageName, // Store only the filename
        ]);
    
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

        // Find the post and update it with the processed body
        $post = Post::findOrFail($id);
        $processedBody = str_replace('\`\`\`', '```', $request->input('body'));

        $post->update([
            'title' => $request->input('title'),
            'body' => $processedBody,
        ]);

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

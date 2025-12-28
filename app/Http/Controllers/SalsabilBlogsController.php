<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalsabilBlog;

class SalsabilBlogsController extends Controller
{

    // Get all blog posts from the database
    public function index()
    {
        $blogs = SalsabilBlog::orderBy('created_at', 'desc')->get();
        // just return as json for testing
        return response()->json($blogs);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string',
            'reference_link' => 'nullable|url',
            'tags' => 'nullable|string',
        ]);

        // Create a new blog post
        $blog = SalsabilBlog::create($validatedData);

        // Return a response, e.g., redirect or JSON
        return response()->json(['message' => 'Blog post created successfully', 'blog' => $blog], 201);
    }
}

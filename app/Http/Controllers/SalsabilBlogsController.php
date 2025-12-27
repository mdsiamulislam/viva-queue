<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalsabilBlog;

class SalsabilBlogsController extends Controller
{

    // Get all blog posts from the database
    public function index()
    {
        $blogs = SalsabilBlog::all();
        // just return as json for testing
        return response()->json($blogs);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeaturedPostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->featured()->with(['category', 'user'])->latest()->paginate(12);
        return view('featured.index', compact('posts'));
    }
}

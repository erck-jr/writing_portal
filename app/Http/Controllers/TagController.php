<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->published()->with(['category', 'user'])->latest()->paginate(12);
        return view('posts.index', compact('posts', 'tag'));
    }
}

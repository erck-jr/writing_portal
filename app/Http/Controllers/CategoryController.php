<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->published()->with(['category', 'user'])->latest()->paginate(12);
        return view('posts.index', compact('posts', 'category'));
    }
}

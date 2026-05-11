<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        $posts = Post::published()
            ->when($query, function($q) use ($query) {
                return $q->where(function($sub) use ($query) {
                    $sub->where('title', 'LIKE', "%{$query}%")
                        ->orWhere('content', 'LIKE', "%{$query}%");
                });
            })
            ->with(['category', 'user'])
            ->latest()
            ->paginate(12);

        return view('posts.index', compact('posts', 'query'));
    }
}

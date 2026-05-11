<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostView;

class PostController extends Controller
{
    public function index()
    {
        $latest_posts = Post::published()->with(['category', 'user'])->latest()->take(6)->get();
        $popular_posts = Post::published()->with(['category', 'user'])
            ->withCount('views')
            ->orderBy('views_count', 'desc')
            ->take(4)
            ->get();
            
        return view('welcome', compact('latest_posts', 'popular_posts'));
    }

    public function listing(Request $request)
    {
        $posts = Post::published()->with(['category', 'user'])->latest()->paginate(12);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }

        $post->load(['category', 'user', 'tags']);

        // Increment views
        PostView::create([
            'post_id' => $post->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $related_posts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'related_posts'));
    }
}

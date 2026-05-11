<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\PostView;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_count' => Post::count(),
            'categories_count' => Category::count(),
            'tags_count' => Tag::count(),
            'total_views' => PostView::count(),
        ];

        $recent_posts = Post::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_posts'));
    }
}

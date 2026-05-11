<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_identifier' => 'nullable|string', // For localStorage identification
        ]);

        if (auth()->check()) {
            $bookmark = Bookmark::where('post_id', $request->post_id)
                ->where('user_id', auth()->id())
                ->first();

            if ($bookmark) {
                $bookmark->delete();
                $status = 'removed';
            } else {
                Bookmark::create([
                    'post_id' => $request->post_id,
                    'user_id' => auth()->id(),
                ]);
                $status = 'added';
            }
        } else {
            // Logic for guest (usually handled in JS, but could be here if using session)
            $status = 'guest_handled';
        }

        return response()->json(['status' => $status]);
    }
}

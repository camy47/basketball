<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function destroy(Post $post)
    {
        if (auth()->user()->user_type !== 'admin') {
            abort(403);
        }

        $post->delete();
        
        return redirect()->back()->with('success', 'Post deleted successfully');
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::with(['user', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('post', compact('post'));
    }
}

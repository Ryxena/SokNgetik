<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::with(['user', 'category'])
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        $latestPosts = Post::with(['user', 'category'])
            ->where('is_featured', false)
            ->latest()
            ->take(6)
            ->get();

        return view('main', compact('featuredPosts', 'latestPosts'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user:id,name')
            ->latest()
            ->take(10)
            ->get(['id', 'title', 'body', 'user_id', 'created_at']);

        return response()->json(['posts' => $posts], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'body'  => $request->body,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'post' => $post
        ], 201);
    }
}

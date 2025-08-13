<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Query\GetLatestPostsWithUserQuery;
use App\Query\Handlers\GetLatestPostsWithUserHandler;

class PostController extends Controller
{
    public function index(GetLatestPostsWithUserHandler $handler)
    {
        $posts = $handler->handle(new GetLatestPostsWithUserQuery(10));

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

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Commands\CreatePostCommand;
use App\Query\GetLatestPostsWithUserQuery;
use App\Commands\Handlers\CreatePostHandler;
use App\Query\Handlers\GetLatestPostsWithUserHandler;

class PostController extends Controller
{
    public function index(GetLatestPostsWithUserHandler $handler)
    {
        $posts = $handler->handle(new GetLatestPostsWithUserQuery(10));

        return response()->json(['posts' => $posts], 200);
    }

    public function store(Request $request, CreatePostHandler $handler)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = $handler->handle(new CreatePostCommand(
            title: $request->title,
            body: $request->body,
            userId: $request->user()->id,
        ));

        return response()->json([
            'post' => $post
        ], 201);
    }
}

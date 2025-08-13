<?php

namespace App\Query\Handlers;

use App\Models\Post;
use App\Query\GetLatestPostsWithUserQuery;

class GetLatestPostsWithUserHandler
{
    public function handle(GetLatestPostsWithUserQuery $query)
    {
        return Post::with('user:id,name')
            ->latest()
            ->take($query->limit)
            ->get(['id', 'title', 'body', 'user_id', 'created_at']);
    }
}
<?php

namespace App\Query\Handlers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use App\Query\GetLatestPostsWithUserQuery;

class GetLatestPostsWithUserHandler
{
    public function handle(GetLatestPostsWithUserQuery $query)
    {
        return Cache::rememberForever(GetLatestPostsWithUserQuery::CACHE_KEY, function () use ($query) {
            return Post::with('user:id,name')
                ->latest()
                ->take($query->limit)
                ->get(['id', 'title', 'body', 'user_id', 'created_at']);
        });
    }
}
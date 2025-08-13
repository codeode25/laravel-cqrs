<?php

namespace App\Commands\Handlers;

use App\Models\Post;
use App\Commands\CreatePostCommand;
use Illuminate\Support\Facades\Cache;
use App\Query\GetLatestPostsWithUserQuery;

class CreatePostHandler
{
    public function handle(CreatePostCommand $command)
    {
        // bussiness rule 1

        // business rule 1

        $post = Post::create([
            'title' => $command->title,
            'body'  => $command->body,
            'user_id' => $command->userId
        ]);

        Cache::forget(GetLatestPostsWithUserQuery::CACHE_KEY);

        return $post;
    }
}
<?php

namespace App\Query;

use App\CQRS\QueryInterface;

class GetLatestPostsWithUserQuery implements QueryInterface
{
    const CACHE_KEY = 'api:posts:latest';

    public function __construct(
        public readonly int $limit = 10
    ) {}
}
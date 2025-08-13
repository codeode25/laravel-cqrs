<?php

namespace App\Query;

class GetLatestPostsWithUserQuery
{
    public function __construct(
        public readonly int $limit = 10
    ) {}
}
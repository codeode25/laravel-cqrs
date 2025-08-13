<?php

namespace App\Query;

use App\CQRS\QueryInterface;

class GetLatestPostsWithUserQuery implements QueryInterface
{
    public function __construct(
        public readonly int $limit = 10
    ) {}
}
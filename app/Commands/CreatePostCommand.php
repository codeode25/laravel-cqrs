<?php

namespace App\Commands;

use App\CQRS\CommandInterface;

class CreatePostCommand implements CommandInterface
{
    public function __construct(
        public readonly string $title,
        public readonly string $body,
        public readonly int $userId
    ) {}
}
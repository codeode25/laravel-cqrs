<?php

namespace App\Commands;

class CreatePostCommand
{
    public function __construct(
        public readonly string $title,
        public readonly string $body,
        public readonly int $userId
    ) {}
}
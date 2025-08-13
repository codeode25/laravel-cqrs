<?php

namespace App\CQRS;

use RuntimeException;
use App\CQRS\QueryInterface;
use App\CQRS\QueryBusInterface;
use App\Query\GetLatestPostsWithUserQuery;
use Illuminate\Contracts\Container\Container;
use App\Query\Handlers\GetLatestPostsWithUserHandler;

class QueryBus implements QueryBusInterface
{
    private array $map = [
        GetLatestPostsWithUserQuery::class => GetLatestPostsWithUserHandler::class,
    ];

    public function __construct(private readonly Container $container) {}

    public function ask(QueryInterface $query)
    {
        $handler = $this->map[$query::class] ?? null;

        if (!$handler) {
            throw new RuntimeException("Failed to find the handler for the query");
        }

        $handler = $this->container->make($handler);

        return $handler->handle($query);
    }
}
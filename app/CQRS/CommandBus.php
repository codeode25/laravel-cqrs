<?php

namespace App\CQRS;

use RuntimeException;
use App\CQRS\CommandInterface;
use App\CQRS\CommandBusInterface;
use App\Commands\CreatePostCommand;
use App\Commands\Handlers\CreatePostHandler;
use Illuminate\Contracts\Container\Container;

class CommandBus implements CommandBusInterface
{
    private array $map = [
        CreatePostCommand::class => CreatePostHandler::class,
    ];

    public function __construct(private readonly Container $container) {}

    public function execute(CommandInterface $command)
    {
        $handler = $this->map[$command::class] ?? null;

        if (!$handler) {
            throw new RuntimeException("Failed to find the handler for the command");
        }

        $handler = $this->container->make($handler);

        return $handler->handle($command);
    }
}
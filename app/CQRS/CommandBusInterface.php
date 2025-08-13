<?php

namespace App\CQRS;

use App\CQRS\CommandInterface;

interface CommandBusInterface
{
    public function execute(CommandInterface $command);
}
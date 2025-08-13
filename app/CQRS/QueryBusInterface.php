<?php

namespace App\CQRS;

use App\CQRS\QueryInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query);
}
<?php

declare(strict_types=1);

namespace App\Application\Shared;

interface CommandBusInterface
{
    public function handle(CommandInterface $command): void;
}

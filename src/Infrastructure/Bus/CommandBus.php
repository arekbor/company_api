<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Shared\CommandBusInterface;
use App\Application\Shared\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {}

    public function handle(CommandInterface $command): void
    {
        $this->messageBus->dispatch($command);
    }
}

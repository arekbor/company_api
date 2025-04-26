<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Shared\CommandBusInterface;
use App\Application\Shared\CommandInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {}

    public function handle(CommandInterface $command): void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (HandlerFailedException $ex) {
            throw $ex->getPrevious() ?? throw new \Exception();
        }
    }
}

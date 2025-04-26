<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Shared\QueryBusInterface;
use App\Application\Shared\QueryInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class QueryBus implements QueryBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {}

    public function ask(QueryInterface $query): mixed
    {
        try {
            $envelope = $this->messageBus->dispatch($query);

            $stamp = $envelope->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (HandlerFailedException $ex) {
            throw $ex->getPrevious() ?? throw new \Exception();
        }
    }
}

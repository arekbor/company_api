<?php

declare(strict_types=1);

namespace App\Api\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = new JsonResponse();

        $response->setData($this->getErrorMessage($exception));

        $event->setResponse($response);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    private function getErrorMessage(\Throwable $exception): array
    {
        return [
            'error' => [
                'detail' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]
        ];
    }
}

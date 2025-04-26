<?php

declare(strict_types=1);

namespace App\Api\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly KernelInterface $kernel
    ) {}

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse();

        if ('dev' === $this->kernel->getEnvironment()) {
            throw $exception;
        }

        if ($exception instanceof UnprocessableEntityHttpException) {
            $this->handleUnprocessableEntityException($exception, $response);
        } elseif ($exception instanceof HttpExceptionInterface) {
            $this->handleHttpException($exception, $response);
        } else {
            $this->handleGeneralException($response);
        }

        $event->setResponse($response);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    private function handleUnprocessableEntityException(UnprocessableEntityHttpException $exception, JsonResponse $response): void
    {
        $previous = $exception->getPrevious();
        if ($previous instanceof ValidationFailedException) {
            $violations = $previous->getViolations();
            $errors = $this->parseValidationErrors($violations);
            $response->setStatusCode($exception->getStatusCode());
            $response->setData(['errors' => $errors]);
        }
    }

    private function handleHttpException(HttpExceptionInterface $exception, JsonResponse $response): void
    {
        $response->setStatusCode($exception->getStatusCode());
        $response->setData([
            'errors' => [$exception->getMessage()],
        ]);
    }

    private function handleGeneralException(JsonResponse $response): void
    {
        $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        $response->setData([
            'errors' => ['An unexpected error occurred'],
        ]);
    }

    private function parseValidationErrors($violations): array
    {
        $errors = [];

        foreach ($violations as $violation) {
            $field = $violation->getPropertyPath();
            $message = $violation->getMessage();
            if (isset($errors[$field])) {
                $errors[$field][] = $message;
            } else {
                $errors[$field] = [$message];
            }
        }

        return $errors;
    }
}

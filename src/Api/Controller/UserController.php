<?php

declare(strict_types=1);

namespace App\Api\Controller;

use App\Application\Shared\CommandBusInterface;
use App\Application\User\Command\Login\LoginCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/user')]
final class UserController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus
    ) {}

    #[Route('/login', name: 'api_user_login', methods: [Request::METHOD_POST])]
    public function register(#[MapRequestPayload] LoginCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}

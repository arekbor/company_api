<?php

declare(strict_types=1);

namespace App\Api\Controller;

use App\Application\Employee\Command\AddEmployeeToCompany\AddEmployeeToCompanyCommand;
use App\Application\Shared\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/employee')]
final class EmployeeController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus
    ) {}

    #[Route('/addToCompany', name: 'api_employee_add_to_company', methods: [Request::METHOD_POST])]
    public function addToCompany(#[MapRequestPayload] AddEmployeeToCompanyCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return $this->json('Employee successfully added to company', Response::HTTP_OK);
    }
}

<?php

declare(strict_types=1);

namespace App\Api\Controller;

use App\Application\Employee\Command\AddEmployeeToCompany\AddEmployeeToCompanyCommand;
use App\Application\Employee\Command\DeleteEmployee\DeleteEmployeeCommand;
use App\Application\Employee\Command\UpdateEmployee\UpdateEmployeeCommand;
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

    #[Route('/update', name: 'api_employee_update', methods: [Request::METHOD_PUT])]
    public function update(#[MapRequestPayload] UpdateEmployeeCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return $this->json('Employee successfully updated', Response::HTTP_OK);
    }

    #[Route('/delete', name: 'api_employee_remove', methods: [Request::METHOD_DELETE])]
    public function delete(#[MapRequestPayload] DeleteEmployeeCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return $this->json('Employee successfully deleted', Response::HTTP_OK);
    }
}

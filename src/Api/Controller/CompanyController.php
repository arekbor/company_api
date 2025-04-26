<?php

declare(strict_types=1);

namespace App\Api\Controller;

use App\Application\Company\Command\CreateCompany\CreateCompanyCommand;
use App\Application\Company\Command\DeleteCompany\DeleteCompanyCommand;
use App\Application\Company\Command\UpdateCompany\UpdateCompanyCommand;
use App\Application\Shared\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/company')]
final class CompanyController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus
    ) {}

    #[Route('/create', name: 'api_company_create', methods: [Request::METHOD_POST])]
    public function create(#[MapRequestPayload] CreateCompanyCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return $this->json('Company successfully created.', Response::HTTP_CREATED);
    }

    #[Route('/delete', name: 'api_company_delete', methods: [Request::METHOD_DELETE])]
    public function delete(#[MapRequestPayload] DeleteCompanyCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return $this->json('Company successfully deleted', Response::HTTP_OK);
    }

    #[Route('/update', name: 'api_company_update', methods: [Request::METHOD_PUT])]
    public function update(#[MapRequestPayload] UpdateCompanyCommand $command): JsonResponse
    {
        $this->commandBus->handle($command);

        return $this->json('Company successfully updated.', Response::HTTP_OK);
    }
}

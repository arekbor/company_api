<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

final class EmployeeAlreadyExistsInCompanyException extends HttpException
{
    public function __construct()
    {
        parent::__construct(409, 'Employee by provided email already exists in this company.');
    }
}

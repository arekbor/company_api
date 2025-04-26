<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

final class CannotDeleteCompanyWithEmployeesException extends HttpException
{
    public function __construct()
    {
        parent::__construct(400, 'Cannot delete company with employees.');
    }
}

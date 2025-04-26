<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

final class EntityNotFoundException extends HttpException
{
    public function __construct(string $message)
    {
        parent::__construct(404, $message);
    }
}

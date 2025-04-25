<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractRepository
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManager
    ) {}
}

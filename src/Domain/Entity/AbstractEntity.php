<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

abstract class AbstractEntity
{
    private UuidInterface $id;

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}

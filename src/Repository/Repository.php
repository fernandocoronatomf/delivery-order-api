<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Entity;

interface Repository
{
    public function generateId(): int;

    public function persist(Entity $data);

    public function retrieve(int $id): Entity;

    public function getAll(): array;

    public function delete(int $id);
}
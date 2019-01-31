<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Entity;
use OutOfBoundsException;

class InMemoryCollection implements Repository
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var int
     */
    private $lastId = 0;

    public function generateId(): int
    {
        $this->lastId++;

        return $this->lastId;
    }

    public function persist(Entity $data)
    {
        $this->data[$this->lastId] = $data;
    }

    public function retrieve(int $id): Entity
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException(
                sprintf('No data found for ID %d', $id)
            );
        }

        return $this->data[$id];
    }

    public function delete(int $id)
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        unset($this->data[$id]);

        return true;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->data;
    }
}

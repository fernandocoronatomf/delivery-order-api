<?php

namespace App\Repository;
;
use App\Domain\Entity;
use App\Domain\EntityId;
use ReflectionClass;

abstract class BaseRepository
{
    /**
     * @var Repository
     */
    protected $persistence;

    public function __construct(Repository $repository)
    {
        $this->persistence = $repository;
    }

    public function findById(EntityId $id): Entity
    {
        try {
            $entity = $this->persistence->retrieve($id->toInt());
        } catch (\OutOfBoundsException $e) {
            throw new \OutOfBoundsException(sprintf(
                'Customer with id %d does not exist', $id->toInt()),
                0,
                $e
            );
        }

        return $entity;
    }

    public function getAll(): array
    {
        return $this->persistence->getAll();
    }

    public function delete(EntityId $id)
    {
        return $this->persistence->delete($id->toInt());
    }

    public function save(Entity $entity): bool
    {
        $this
            ->persistence
            ->persist($entity);

        return true;
    }



}
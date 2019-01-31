<?php

declare(strict_types=1);

namespace App\Domain\Customer;

use App\Domain\Entity;
use App\Domain\EntityId;

class Customer implements Entity
{
    /**
     * @var CustomerId
     */
    private $id;

    /** @var string */
    private $name;

    /**
     * @param array $state
     * @return Customer
     */
    public static function fromState(array $state): Entity
    {
        return new self(
            CustomerId::fromInt($state['id']),
            $state['name']
        );
    }

    /**
     * Customer constructor.
     * @param EntityId $id
     * @param string $name
     */
    private function __construct(EntityId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): EntityId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
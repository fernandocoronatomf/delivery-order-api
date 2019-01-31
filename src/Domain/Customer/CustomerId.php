<?php

declare(strict_types=1);

namespace App\Domain\Customer;

use App\Domain\BaseEntityId;
use App\Domain\EntityId;

class CustomerId extends BaseEntityId implements EntityId
{
    /**
     * @param int $id
     * @return EntityId
     */
    public static function fromInt(int $id): EntityId
    {
        self::ensureIsValid($id);

        return new self($id);
    }

    /**
     * CustomerId constructor.
     * @param int $id
     */
    private function __construct(int $id)
    {
        $this->id = $id;
    }
}
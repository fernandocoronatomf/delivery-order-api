<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Customer\Customer;
use App\Domain\Customer\CustomerId;
use App\Domain\EntityId;

class CustomerRepository extends BaseRepository
{
    /**
     * Used for parent class find out main entity to work with
     */
    private const ENTITY = Customer::class;

    public function generateId(): EntityId
    {
        return CustomerId::fromInt($this->persistence->generateId());
    }
}
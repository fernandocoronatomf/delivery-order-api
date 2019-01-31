<?php

declare(strict_types=1);

namespace App\Domain;

use InvalidArgumentException;

abstract class BaseEntityId
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function toInt(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    protected static function ensureIsValid(int $id)
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid CustomerId given');
        }
    }
}
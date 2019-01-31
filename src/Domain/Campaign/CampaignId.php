<?php

declare(strict_types=1);

namespace App\Domain\Campaign;

use App\Domain\BaseEntityId;
use App\Domain\EntityId;

class CampaignId extends BaseEntityId implements EntityId
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
     * @codeCoverageIgnore
     * We could implement a Uuid for the campaign
     */
    public function toUuid()
    {
        // return Uuid::convert($this->>id);
        return $this->id;

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
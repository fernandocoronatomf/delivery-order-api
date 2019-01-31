<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Campaign\Campaign;
use App\Domain\Campaign\CampaignId;
use App\Domain\EntityId;

class CampaignRepository extends BaseRepository
{
    /**
     * Used for parent class find out main entity to work with
     */
    private const ENTITY = Campaign::class;

    public function generateId(): EntityId
    {
        return CampaignId::fromInt($this->persistence->generateId());
    }
}
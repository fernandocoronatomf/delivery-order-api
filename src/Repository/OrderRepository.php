<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\EntityId;
use App\Domain\DeliveryOrder\DeliveryOrder;
use App\Domain\DeliveryOrder\CampaignId;
use App\Domain\DeliveryOrder\DeliveryOrderId;

class OrderRepository extends BaseRepository
{
    /**
     * Used for parent class find out main entity to work with
     */
    private const ENTITY = DeliveryOrder::class;

    public function generateId(): EntityId
    {
        return DeliveryOrderId::fromInt($this->persistence->generateId());
    }
}
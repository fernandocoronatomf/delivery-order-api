<?php

namespace App\Service\Marketing;

use App\Domain\DeliveryOrder\DeliveryOrder;

class CampaignTracker implements SuccessLogger
{
    /** @var DeliveryOrder  */
    private $deliveryOrder;

    public function __construct(DeliveryOrder $deliveryOrder)
    {
        $this->deliveryOrder = $deliveryOrder;
    }

    /***
     * Records successful order coming through Campaign
     */
    public function logSuccess()
    {
        echo sprintf(
            'Order no %d was created through campaign %s and logged on marketing service %s',
            $this->deliveryOrder->getId()->toInt(),
            $this->deliveryOrder->getCampaign()->getName(),
            '<br>'
        );
    }
}
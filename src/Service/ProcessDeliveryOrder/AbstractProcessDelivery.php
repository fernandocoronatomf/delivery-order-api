<?php

namespace App\Service\ProcessDeliveryOrder;

use App\Domain\DeliveryOrder\DeliveryOrder;
use App\Service\Marketing\CampaignTracker;
use ReflectionClass;

abstract class AbstractProcessDelivery
{
    /**
     * @var DeliveryOrder
     */
    protected $deliveryOrder;

    /**
     * AbstractProcessDelivery constructor.
     * @param DeliveryOrder $deliveryOrder
     */
    public function __construct(DeliveryOrder $deliveryOrder)
    {
        $this->deliveryOrder = $deliveryOrder;
    }

    public function process(): bool
    {
        $this->communicateMarketingSuccess();

        return true;
    }

    public function deliver()
    {
        echo sprintf(
            'Order no %d processed and will be delived in %d days %s',
            $this->deliveryOrder->getId()->toInt(),
            $this->getChildDeliveryTime(),
            '<br><br>'
        );
    }

    /**
     * @return int
     * @throws \ReflectionException
     */
    private function getChildDeliveryTime(): int
    {
        return (new ReflectionClass(get_called_class()))
            ->getConstant('DELIVERY_TIME_IN_DAYS');
    }

    private function communicateMarketingSuccess()
    {
        if ($this->deliveryOrder->getCampaign() === null) {
            return;
        }

        (new CampaignTracker($this->deliveryOrder))->logSuccess();
    }
}
<?php

namespace App\Service\ProcessDeliveryOrder;

use App\Domain\DeliveryOrder\DeliveryOrder;

/**
 * Using the factory design pattern to generate a class implementing interface Delivery
 * Class ProcessDeliverFactory
 * @package App\Domain\DeliveryOrder
 */
class ProcessDeliverFactory
{
    /**
     * @var DeliveryOrder
     */
    private $deliveryOrder;

    public function __construct(DeliveryOrder $deliveryOrder)
    {
        $this->deliveryOrder = $deliveryOrder;
    }

    /**
     * @param string $deliveryType
     * @return Delivery
     */
    public function create(string $deliveryType): Delivery
    {
        if ($deliveryType === 'personalDelivery') {
            return new ProcessPersonalDelivery($this->deliveryOrder);
        } elseif ($deliveryType === 'personalDeliveryExpress') {
            return new ProcessPersonalDeliveryExpress($this->deliveryOrder);
        } elseif ($deliveryType === 'enterpriseDelivery') {
            return new ProcessEnterpriseDelivery($this->deliveryOrder);
        }

        throw new \InvalidArgumentException('Object does not exist');
    }
}
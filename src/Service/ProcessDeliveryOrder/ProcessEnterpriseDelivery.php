<?php

namespace App\Service\ProcessDeliveryOrder;

class ProcessEnterpriseDelivery extends AbstractProcessDelivery implements Delivery
{
    /** @var int This is used by parent class */
    private const DELIVERY_TIME_IN_DAYS = 1;

    /**
     * We can add more functionality here for each implementation of processing order
     * The marketing communication is handled on the parent
     * Not having any extra functionality on this method we could remove it from here and have it only on parent
     * @return bool
     */
    public function process(): bool
    {
        parent::process();

        return $this->validateEnterpriseFromExternalService();
    }

    /**
     * This is mocking a method that would handle this validation for a external api
     * @return bool
     */
    private function validateEnterpriseFromExternalService(): bool
    {
        echo sprintf(
            'Order no %d sent to external api to be validated %s',
            $this->deliveryOrder->getId()->toInt(),
            '<br>'
        );

        return true;
    }
}
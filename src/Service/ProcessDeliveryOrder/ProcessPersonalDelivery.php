<?php

namespace App\Service\ProcessDeliveryOrder;


class ProcessPersonalDelivery extends AbstractProcessDelivery implements Delivery
{
    /** @var int This is used by parent class */
    private const DELIVERY_TIME_IN_DAYS = 10;

    /**
     * We can add more functionality here for each implementation of processing order
     * The marketing communication is handled on the parent
     * Not having any extra functionality on this method we could remove it from here and have it only on parent
     * @return bool
     */
    public function process(): bool
    {
        parent::process();

        return true;
    }
}
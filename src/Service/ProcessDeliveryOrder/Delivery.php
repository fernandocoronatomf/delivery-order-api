<?php

namespace App\Service\ProcessDeliveryOrder;

interface Delivery
{
    public function process(): bool;

    public function deliver();
}
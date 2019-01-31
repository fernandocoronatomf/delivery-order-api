<?php

namespace App\Service\ProcessDeliveryOrder;

use App\Service\Mapper\OrderListMapper;
use App\Service\Reader\Reader;

class ProcessDeliveryOrder
{
    /**
     * @var Reader
     */
    private $reader;
    /**
     * @var OrderListMapper
     */
    private $orderListMapper;

    /**
     * @var int
     */
    private $processedOrders = 0;

    public function __construct(Reader $reader, OrderListMapper $orderListMapper)
    {
        $this->reader = $reader;
        $this->orderListMapper = $orderListMapper;
    }

    /**
     * @return bool
     */
    public function process(): bool
    {
        $orderList = $this->reader->readFile();
        $this->orderListMapper->saveEntities($orderList);

        foreach ($this->orderListMapper->getOrderRepository()->getAll() as $order) {
            $processDeliverObject = (new ProcessDeliverFactory($order))->create($order->getDeliveryType());
            if ($processDeliverObject->process($order)) {
                $processDeliverObject->deliver();
                $this->processedOrders++;
            }
        }

        return true;
    }

    /**
     * @return int
     */
    public function totalProcessedOrders(): int
    {
        return $this->processedOrders;
    }
}
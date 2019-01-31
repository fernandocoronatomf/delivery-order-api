<?php

namespace Tests;

use App\Domain\DeliveryOrder\DeliveryOrder;
use App\Domain\DeliveryOrder\DeliveryOrderId;
use App\Repository\InMemoryCollection;
use App\Repository\OrderRepository;
use App\Service\ProcessDeliveryOrder\ProcessDeliverFactory;
use PHPUnit\Framework\TestCase;

class ProcessDeliverFactoryTest extends TestCase
{
    /** @test */
    public function it_throws_exception_if_type_does_not_exist()
    {
        $orderRepository = new OrderRepository(new InMemoryCollection());

        $deliveryorder = DeliveryOrder::fromState([
            'id' => DeliveryOrderId::fromInt($orderRepository->generateId()->toInt()),
            'deliveryType' => 'invalid-type',
            'source' => 'xxx',
            'weight' => '300',
        ]);

        $this->expectException(\InvalidArgumentException::class);

        (new ProcessDeliverFactory($deliveryorder))->create($deliveryorder->getDeliveryType());

    }
}
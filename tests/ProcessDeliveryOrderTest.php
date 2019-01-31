<?php

use App\Repository\CampaignRepository;
use App\Repository\CustomerRepository;
use App\Repository\InMemoryCollection;
use App\Repository\OrderRepository;
use App\Service\Mapper\OrderListMapper;
use App\Service\ProcessDeliveryOrder\ProcessDeliveryOrder;
use App\Service\Reader\JsonReaderToArrayDecorator;
use App\Service\Reader\JsonReader;
use PHPUnit\Framework\TestCase;

class ProcessDeliveryOrderTest extends TestCase
{
    /** @test */
    public function it_process_delivery_orders()
    {
        // Read Json File
        $arrayReaderDecorator = new JsonReaderToArrayDecorator(new JsonReader(__ROOT__ . 'orders.json'));

        // Initiating repositories
        $orderRepository = new OrderRepository(new InMemoryCollection());
        $customerRepository = new CustomerRepository(new InMemoryCollection());
        $campaignRepository = new CampaignRepository(new InMemoryCollection());

        $orderListMapper = new OrderListMapper($customerRepository, $campaignRepository, $orderRepository);

        $processDeliveryOrderFacade = new ProcessDeliveryOrder($arrayReaderDecorator, $orderListMapper);
        $processDeliveryOrderFacade->process();

        $this->assertEquals(
            3,
            $processDeliveryOrderFacade->totalProcessedOrders()
        );
    }
}
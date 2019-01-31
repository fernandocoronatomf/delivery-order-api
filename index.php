<?php

use App\Repository\CampaignRepository;
use App\Repository\CustomerRepository;
use App\Repository\InMemoryCollection;
use App\Repository\OrderRepository;
use App\Service\Mapper\OrderListMapper;
use App\Service\ProcessDeliveryOrder\ProcessDeliveryOrder;
use App\Service\Reader\JsonReader;
use App\Service\Reader\JsonReaderToArrayDecorator;

require __DIR__ . '/vendor/autoload.php';

// Read Json File
$jsonConvertedToArray = new JsonReaderToArrayDecorator(new JsonReader(__ROOT__ . 'orders.json'));

// Initiating repositories
$orderRepository = new OrderRepository(new InMemoryCollection());
$customerRepository = new CustomerRepository(new InMemoryCollection());
$campaignRepository = new CampaignRepository(new InMemoryCollection());

$orderListMapper = new OrderListMapper($customerRepository, $campaignRepository, $orderRepository);

$processDeliveryOrderFacade = new ProcessDeliveryOrder($jsonConvertedToArray, $orderListMapper);
$processDeliveryOrderFacade->process();
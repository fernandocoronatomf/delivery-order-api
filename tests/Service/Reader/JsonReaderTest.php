<?php

use App\Repository\CampaignRepository;
use App\Repository\CustomerRepository;
use App\Repository\InMemoryCollection;
use App\Repository\OrderRepository;
use App\Service\Mapper\OrderListMapper;
use App\Service\Reader\FileDoesNotExistException;
use App\Service\Reader\JsonReaderToArrayDecorator;
use App\Service\Reader\JsonReader;
use PHPUnit\Framework\TestCase;

class JsonReaderTest extends TestCase
{
    /** @test */
    public function it_reads_json_order_and_map_to_specific_entities()
    {
        $arrayReaderDecorator = new JsonReaderToArrayDecorator(new JsonReader(__ROOT__ . 'orders.json'));

        $orderList = $arrayReaderDecorator->readFile();

        $orderRepository = new OrderRepository(new InMemoryCollection());
        $customerRepository = new CustomerRepository(new InMemoryCollection());
        $campaignRepository = new CampaignRepository(new InMemoryCollection());

        $mapper = new OrderListMapper($customerRepository, $campaignRepository, $orderRepository);

        $mapper->saveEntities($orderList);

        $this->assertCount(
            3,
            $orderRepository->getAll()
        );

        $this->assertInstanceOf(
            \App\Domain\Customer\Customer::class,
            $orderRepository->getAll()[1]->getCustomer()
        );

        $this->assertCount(
            3,
            $customerRepository->getAll()
        );
    }

    /** @test */
    public function it_throws_exception_if_file_does_not_exist()
    {
        $this->expectException(FileDoesNotExistException::class);
        new JsonReader(__ROOT__ . 'orders2.json');
    }
}
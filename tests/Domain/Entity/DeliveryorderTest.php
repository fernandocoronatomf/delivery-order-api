<?php

namespace Tests;

use App\Domain\Customer\Customer;
use App\Domain\Customer\CustomerId;
use App\Domain\DeliveryOrder\DeliveryOrder;
use App\Domain\DeliveryOrder\DeliveryOrderId;
use App\Repository\CustomerRepository;
use App\Repository\InMemoryCollection;
use App\Repository\OrderRepository;
use PHPUnit\Framework\TestCase;

class DeliveryorderTest extends TestCase
{
    /** @test */
    public function it_adds_a_new_delivery_order()
    {
        $persistence = new InMemoryCollection();

        $orderRepository = new OrderRepository($persistence);
        $deliveryOrder = DeliveryOrder::fromState([
            'id' => DeliveryOrderId::fromInt($orderRepository->generateId()->toInt()),
            'deliveryType' => 'personalDelivery',
            'source' => 'email',
            'weight' => '300',
        ]);
        $orderRepository->save($deliveryOrder);

        $this->assertTrue($deliveryOrder->getId() instanceof DeliveryOrderId);
        $this->assertTrue($deliveryOrder->getSource() === 'email');
        $this->assertTrue($deliveryOrder->getWeight() === '300');
    }

    /** @test */
    public function it_throws_an_exception_if_id_is_less_than_0()
    {
        $this->expectException(\InvalidArgumentException::class);
        Customer::fromState([
            'id' => -1,
            'name' => 'Fernando',
        ]);
    }

    /** @test */
    public function it_gets_all_customers()
    {
        $persistence = new InMemoryCollection();

        $customerRepository = new CustomerRepository($persistence);
        $customer = Customer::fromState([
            'id' => $customerRepository->generateId()->toInt(),
            'name' => 'Fernando',
        ]);
        $customerRepository->save($customer);

        $newCustomer = Customer::fromState([
            'id' => $customerRepository->generateId()->toInt(),
            'name' => 'Customer II',
        ]);

        $customerRepository->save($newCustomer);

        $this->assertCount(
            2,
            $customerRepository->getAll()
        );

        $customerRepository->findById(CustomerId::fromInt(1));


        $this->expectException(\OutOfBoundsException::class);
        $customerRepository->findById(CustomerId::fromInt(10));
    }

    /** @test */
    public function it_deletes_a_customer()
    {
        $persistence = new InMemoryCollection();

        $customerRepository = new CustomerRepository($persistence);
        $customer = Customer::fromState([
            'id' => $customerRepository->generateId()->toInt(),
            'name' => 'Fernando',
        ]);
        $customerRepository->save($customer);

        $newCustomer = Customer::fromState([
            'id' => $customerRepository->generateId()->toInt(),
            'name' => 'Customer II',
        ]);

        $customerRepository->save($newCustomer);

        $this->assertCount(
            2,
            $customerRepository->getAll()
        );

        $deleted = $customerRepository->delete(CustomerId::fromInt(1));
        $this->assertTrue($deleted);

        $this->expectException(\OutOfBoundsException::class);
        $customerRepository->delete(CustomerId::fromInt(10));
    }
}
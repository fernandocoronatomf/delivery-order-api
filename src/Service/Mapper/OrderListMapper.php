<?php

namespace App\Service\Mapper;

use App\Domain\Campaign\Campaign;
use App\Domain\Customer\Customer;
use App\Domain\DeliveryOrder\DeliveryOrder;
use App\Domain\DeliveryOrder\DeliveryOrderId;
use App\Repository\CampaignRepository;
use App\Repository\CustomerRepository;
use App\Repository\OrderRepository;

class OrderListMapper
{
    /** @var CustomerRepository */
    private $customerRepository;

    /** @var OrderRepository */
    private $orderRepository;

    /** @var CampaignRepository  */
    private $campaignRepository;

    public function __construct(
        CustomerRepository $customerRepository,
        CampaignRepository $campaignRepository,
        OrderRepository $orderRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->campaignRepository = $campaignRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return $this
     */
    public function saveEntities($orderList)
    {
        foreach ($orderList as $index => $orderArray) {

            $customer = $this->mapCustomer($orderArray['customer']);

            $campaign = null;
            if (array_key_exists('campaign', $orderArray)) {
                $campaign = $this->mapCampaign($orderArray['campaign']);
            }

            $this->mapOrder($orderArray, $customer, $campaign);
        }

        return $this;
    }

    /**
     * @return OrderRepository
     */
    public function getOrderRepository(): OrderRepository
    {
        return $this->orderRepository;
    }

    /**
     * @param array $orderArray
     * @param Customer $customer
     * @param Campaign|null $campaign
     */
    private function mapOrder(array $orderArray, Customer $customer, Campaign $campaign = null)
    {
        $order = DeliveryOrder::fromState([
            'id' => DeliveryOrderId::fromInt($this->orderRepository->generateId()->toInt()),
            'deliveryType' => $orderArray['deliveryType'],
            'source' => $orderArray['source'],
            'weight' => $orderArray['weight']
        ]);

        $order->setCustomer($customer);

        if ($campaign) {
            $order->setCampaign($campaign);
        }

        $this->orderRepository->save($order);
    }

    /**
     * @param $orderArray
     * @return Customer
     */
    private function mapCustomer($orderArray): Customer
    {
        $customer = Customer::fromState([
            'id' => $this->customerRepository->generateId()->toInt(),
            'name' => $orderArray['name'],
        ]);

        $this->customerRepository->save($customer);

        return $customer;
    }

    /**
     * @param array $campaignArray
     * @return Campaign
     */
    private function mapCampaign(array $campaignArray): Campaign
    {
        $campaign = Campaign::fromState([
            'id' => $this->campaignRepository->generateId(),
            'name' => $campaignArray['name'],
            'type' => $campaignArray['type'],
            'ads' => $campaignArray['ad']
        ]);

        $this->campaignRepository->save($campaign);

        return $campaign;
    }
}
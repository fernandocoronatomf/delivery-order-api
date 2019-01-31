<?php

namespace App\Domain\DeliveryOrder;

use App\Domain\Campaign\Campaign;
use App\Domain\Customer\Customer;
use App\Domain\Entity;
use App\Domain\EntityId;

class DeliveryOrder implements Entity
{
    /**
     * @var int
     */
    private $id;

    /** @var string */
    private $deliveryType;

    /** @var string */
    private $source;

    /** @var string */
    private $weight;

    /** @var Customer */
    private $customer;

    /** @var Campaign */
    private $campaign;

    /**
     * @param array $state
     * @return Customer
     */
    public static function fromState(array $state): Entity
    {
        return new self(
            $state['id'],
            $state['deliveryType'],
            $state['source'],
            $state['weight']
        );
    }

    /**
     * Order constructor.
     * @param int $id
     * @param string $deliveryType
     * @param string $source
     * @param string $weight
     */
    private function __construct(
        EntityId $id,
        string $deliveryType,
        string $source,
        string $weight
    )
    {
        $this->id = $id;
        $this->deliveryType = $deliveryType;
        $this->source = $source;
        $this->weight = $weight;
    }

    public function getId(): EntityId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getWeight(): string
    {
        return $this->weight;
    }

    /**
     * @param Customer $customer
     * @return $this
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }


    /**
     * @param Campaign $campaign
     * @return $this
     */
    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }

    /**
     * @return Campaign|null
     */
    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }
}
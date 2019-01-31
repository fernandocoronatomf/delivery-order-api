<?php

namespace App\Domain\Campaign;

use App\Domain\Customer\Customer;
use App\Domain\Entity;
use App\Domain\EntityId;

class Campaign implements Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $ads;

    /**
     * @param array $state
     * @return Customer
     */
    public static function fromState(array $state): Entity
    {
        return new self(
            $state['id'],
            $state['name'],
            $state['type'],
            $state['ads']
        );
    }

    /**
     * Campaign constructor.
     * @param EntityId $id
     * @param string $name
     * @param string $type
     * @param string $ads
     */
    private function __construct(
        EntityId $id,
        string $name,
        string $type,
        string $ads
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->ads = $ads;
    }

    public function getId(): EntityId
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAds(): string
    {
        return $this->ads;
    }
}
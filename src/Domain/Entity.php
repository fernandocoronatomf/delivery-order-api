<?php

namespace App\Domain;

interface Entity
{
    public static function fromState(array $state): Entity;

    public function getId(): EntityId;

}
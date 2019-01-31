<?php

namespace App\Domain;

interface EntityId
{
    public static function fromInt(int $id): EntityId;

    public function toInt(): int;
}
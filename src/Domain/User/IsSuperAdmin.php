<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidEmailException;

final class IsSuperAdmin 
{
    private function __construct(public readonly bool $value)
    {
    }

    public static function fromBool(bool $value): self
    {
        return new self($value);
    }
}

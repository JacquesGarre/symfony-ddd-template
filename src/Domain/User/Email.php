<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidEmailException;

final class Email
{
    private function __construct(public readonly string $value)
    {
    }

    public static function fromString(string $value): self
    {
        self::assertValid($value);
        return new self($value);
    }

    public static function assertValid(string $value): void
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return;
        }
        throw new InvalidEmailException();
    }
}

<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidIdException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Id
{
    private function __construct(public readonly UuidInterface $value)
    {
    }

    public static function fromString(string $value): self
    {
        self::assertValid($value);
        $uuid = Uuid::fromString($value);
        return new self($uuid);
    }

    public static function assertValid(string $value): void
    {
        if (Uuid::isValid($value)) {
            return;
        }
        throw new InvalidIdException();
    }

    public function equals(Id $id): bool
    {
        return $this->value->equals($id->value);
    }
}

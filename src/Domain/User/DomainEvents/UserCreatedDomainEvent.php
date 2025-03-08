<?php

namespace App\Domain\User\DomainEvents;

use App\Domain\Shared\AbstractDomainEvent;
use App\Domain\User\User;

final class UserCreatedDomainEvent extends AbstractDomainEvent
{
    private const NAME = "UserCreatedDomainEvent";

    private function __construct(public readonly User $user)
    {
        parent::__construct($user->id->value);
    }

    public static function fromUser(User $user): self
    {
        return new self($user);
    }

    public function eventName(): string
    {
        return self::NAME;
    }
}

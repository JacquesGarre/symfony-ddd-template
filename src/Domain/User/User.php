<?php

namespace App\Domain\User;

use App\Domain\Shared\AggregateRoot;
use App\Domain\User\DomainEvents\UserCreatedDomainEvent;

final class User extends AggregateRoot {

    private function __construct(
        public readonly Id $id,
        public readonly Email $email,
        public readonly PasswordHash $passwordHash,
        public readonly IsSuperAdmin $isSuperAdmin
    ) {
    }

    public static function create(
        Id $id,
        Email $email,
        PasswordHash $passwordHash
    ): self {
        $isSuperAdmin = IsSuperAdmin::fromBool(false);
        $user = new self($id, $email, $passwordHash, $isSuperAdmin);
        $user->notify(UserCreatedDomainEvent::fromUser($user));
        return $user;
    }

    public function isSuperAdmin(): bool
    {
        return $this->isSuperAdmin->value;
    }
}
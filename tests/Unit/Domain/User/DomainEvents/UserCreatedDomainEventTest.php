<?php

namespace App\Tests\Unit\Domain\User\DomainEvents;

use App\Domain\User\DomainEvents\UserCreatedDomainEvent;
use App\Tests\Stubs\Domain\User\UserStubs;
use PHPUnit\Framework\TestCase;

final class UserCreatedDomainEventTest extends TestCase {

    public function testDomainEvent(): void
    {
        $user = UserStubs::user();
        $domainEvent = UserCreatedDomainEvent::fromUser($user);
        self::assertEquals($user, $domainEvent->user);
        self::assertEquals($user->id->value, $domainEvent->aggregateId());
    }
}
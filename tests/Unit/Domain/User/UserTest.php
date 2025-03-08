<?php

namespace App\Tests\Unit\Domain\User;

use App\Domain\User\DomainEvents\UserCreatedDomainEvent;
use App\Domain\User\User;
use App\Tests\Stubs\Domain\User\UserStubs;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testCreate(): void
    {
        $id = UserStubs::id();
        $email = UserStubs::email();
        $passwordHash = UserStubs::passwordHash();
        $user = User::create($id, $email, $passwordHash);
        self::assertEquals($id, $user->id);
        self::assertEquals($email, $user->email);
        self::assertEquals($passwordHash, $user->passwordHash);
        self::assertFalse($user->isSuperAdmin->value);
        $domainEvents = $user->pullDomainEvents();
        self::assertEquals(1, count($domainEvents));
        self::assertInstanceOf(UserCreatedDomainEvent::class, $domainEvents[0]);
    }

    public function testIsSuperAdmin(): void
    {
        $user = UserStubs::user();
        self::assertFalse($user->isSuperAdmin());
    }
}

<?php

namespace App\Tests\Unit\Domain\User;

use App\Domain\User\PasswordHash;
use App\Domain\User\Exception\PasswordTooWeakException;
use App\Domain\User\Exception\WrongPasswordException;
use PHPUnit\Framework\TestCase;

final class PasswordHashTest extends TestCase {

    public function testConstructor(): void
    {
        $value = "str0ngP@ssw0rD";
        $passwordHash = PasswordHash::fromString($value);
        self::assertNotEquals($value, $passwordHash->value);
    }

    public function testPasswordTooWeakException(): void
    {
        $value = "weak";
        $this->expectException(PasswordTooWeakException::class);
        PasswordHash::fromString($value);
    }

    public function testEmptyPasswordHash(): void
    {
        $value = "";
        $this->expectException(PasswordTooWeakException::class);
        PasswordHash::fromString($value);
    }

    public function testWrongPasswordException(): void
    {
        $value = "str0ngP@ssw0rD";
        $passwordHash = PasswordHash::fromString($value);
        $this->expectException(WrongPasswordException::class);
        $wrongPassword = "pwd";
        $passwordHash->matches($wrongPassword);
    }

    public function testMatches(): void
    {
        $value = "str0ngP@ssw0rD";
        $passwordHash = PasswordHash::fromString($value);
        $this->expectNotToPerformAssertions();
        $passwordHash->matches($value);
    }
}
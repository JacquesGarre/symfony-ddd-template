<?php

namespace App\Domain\User;

use App\Domain\User\Exception\PasswordTooWeakException;
use App\Domain\User\Exception\WrongPasswordException;

final class PasswordHash {

    private const PASSWORD_STRENGTH_REGEX = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/';

    private function __construct(public readonly string $value)
    {
    }

    public static function fromString(string $value): self
    {
        self::assertValid($value);
        $hashedValue = password_hash($value, PASSWORD_DEFAULT);
        return new self($hashedValue);
    }

    public static function assertValid(string $value): void
    {
        if (preg_match(self::PASSWORD_STRENGTH_REGEX, $value)) {
            return;
        }
        throw new PasswordTooWeakException();
    }

    public function matches(string $value): void
    {   
        if (password_verify($value, $this->value)) {
            return;
        }
        throw new WrongPasswordException();
    }

}
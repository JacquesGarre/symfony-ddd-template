<?php

namespace App\Tests\Unit\Domain\User;

use App\Domain\User\Email;
use Faker\Factory;
use App\Domain\User\Exception\InvalidEmailException;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testConstructor(): void
    {
        $faker = Factory::create();
        $value = $faker->email();
        $email = Email::fromString($value);
        self::assertEquals($value, $email->value);
    }

    public function testInvalidEmailException(): void
    {
        $faker = Factory::create();
        $value = $faker->word();
        $this->expectException(InvalidEmailException::class);
        Email::fromString($value);
    }

    public function testEmptyEmail(): void
    {
        $value = "";
        $this->expectException(InvalidEmailException::class);
        Email::fromString($value);
    }
}

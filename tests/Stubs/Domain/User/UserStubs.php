<?php

namespace App\Tests\Stubs\Domain\User;

use App\Domain\User\Email;
use App\Domain\User\Id;
use App\Domain\User\PasswordHash;
use App\Domain\User\User;
use Faker\Factory;

final class UserStubs {

    public static function id(): Id
    {
        $faker = Factory::create();
        return Id::fromString($faker->uuid());
    }

    public static function email(): Email
    {
        $faker = Factory::create();
        return Email::fromString($faker->email());
    }

    public static function passwordHash(): PasswordHash
    {
        return PasswordHash::fromString("@str0nGpassWord");
    }

    public static function user(): User
    {
        return User::create(
            self::id(), 
            self::email(), 
            self::passwordHash(),
        );
    }
}
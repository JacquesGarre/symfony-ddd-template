<?php

namespace App\Tests\Unit\Domain\User;

use App\Domain\User\Exception\InvalidIdException;
use App\Domain\User\Id;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

final class IdTest extends TestCase {

    public function testConstructor(): void
    {
        $faker = Factory::create();
        $uuid = $faker->uuid();
        $id = Id::fromString($uuid);
        self::assertEquals($uuid, $id->value);
    }

    public function testInvalidIdException(): void
    {
        $faker = Factory::create();
        $uuid = $faker->word();
        $this->expectException(InvalidIdException::class);
        Id::fromString($uuid);
    }

    public function testEmptyIdException(): void
    {
        $uuid = "";
        $this->expectException(InvalidIdException::class);
        Id::fromString($uuid);
    }

    public function testEquals(): void
    {
        $faker = Factory::create();
        $uuid = $faker->uuid();
        $id1 = Id::fromString($uuid);
        $id2 = Id::fromString($uuid);
        $id3 = Id::fromString($faker->uuid());
        self::assertTrue($id1->equals($id2));
        self::assertFalse($id3->equals($id1));
    }
}
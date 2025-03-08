<?php

namespace App\Tests\Integration;

use PHPUnit\Framework\TestCase;

final class DummyTest extends TestCase
{
    public function testDummy(): void
    {
        $this->expectNotToPerformAssertions();
    }
}

<?php

namespace App\Tests\Integration;

use PHPUnit\Framework\TestCase;

final class DummyTest extends TestCase
{
    public function dummy(): void
    {
        $this->expectNotToPerformAssertions();
    }
}

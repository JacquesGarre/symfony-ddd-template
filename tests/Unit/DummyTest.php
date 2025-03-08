<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;

final class DummyTest extends TestCase
{
    public function dummy(): void
    {
        $this->expectNotToPerformAssertions();
    }
}

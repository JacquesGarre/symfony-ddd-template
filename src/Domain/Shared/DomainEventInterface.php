<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

interface DomainEventInterface
{
    public function eventName(): string;
    public function occuredOn(): DateTimeImmutable;
    public function aggregateId(): UuidInterface;
}

<?php

declare(strict_types=1);

namespace App\Shared\DomainEvent\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

abstract class AbstractDomainEvent implements DomainEventInterface {

    public readonly UuidInterface $eventId;
    public readonly DateTimeImmutable $occuredOn;

    public function __construct(
        public readonly UuidInterface $aggregateId,
    )
    {
        $this->eventId = Uuid::uuid4();
        $this->occuredOn = new DateTimeImmutable();
    }

    public function occuredOn(): DateTimeImmutable
    {
        return $this->occuredOn;
    }

    public function aggregateId(): UuidInterface
    {
        return $this->aggregateId;
    }
}
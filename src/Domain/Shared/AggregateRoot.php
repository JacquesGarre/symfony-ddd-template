<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Shared\DomainEventInterface;

abstract class AggregateRoot {

    /** @var DomainEventInterface[] */
    private $domainEvents = [];

    public function notify(DomainEventInterface $event): void
    {
        $this->domainEvents[] = $event;
    }

    /**
     * @return DomainEventInterface[]
     */
    public function pullDomainEvents(): array
    {
        return $this->domainEvents;
    }
}
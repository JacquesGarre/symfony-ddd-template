<?php

declare(strict_types=1);

namespace App\Shared\Aggregate\Domain;

use App\Shared\DomainEvent\Domain\DomainEventInterface;

abstract class AggregateRoot {

    private $domainEvents = [];

    public function notify(DomainEventInterface $event) 
    {
        $this->domainEvents[] = $event;
    }

    public function pullDomainEvents(): array
    {
        return $this->domainEvents;
    }
}
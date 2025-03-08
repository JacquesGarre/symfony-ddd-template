<?php

declare(strict_types=1);

namespace App\Shared\DomainEvent\Domain;

interface DomainEventBusInterface {
    public function publish(DomainEventInterface ...$events): void;
}
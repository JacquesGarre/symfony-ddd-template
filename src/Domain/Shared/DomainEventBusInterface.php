<?php

declare(strict_types=1);

namespace App\Domain\Shared;

interface DomainEventBusInterface {
    public function publish(DomainEventInterface ...$events): void;
}
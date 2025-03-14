<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared;

use App\Domain\Shared\DomainEventBusInterface;
use App\Domain\Shared\DomainEventInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class DomainEventBus implements DomainEventBusInterface
{
    public function __construct(public readonly MessageBusInterface $messageBus)
    {
    }

    public function publish(DomainEventInterface ...$events): void
    {
        foreach ($events as $event) {
            try {
                $this->messageBus->dispatch($event);
            } catch (HandlerFailedException $e) {
                while ($e instanceof HandlerFailedException) {
                    /** @var Throwable $e */
                    $e = $e->getPrevious();
                }
                throw $e;
            }
        }
    }
}

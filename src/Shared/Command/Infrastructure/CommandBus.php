<?php

declare(strict_types=1);

namespace App\Shared\Command\Infrastructure;

use App\Shared\Command\Domain\AbstractCommand;
use App\Shared\Command\Domain\CommandBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements CommandBusInterface {

    public function __construct(public readonly MessageBusInterface $messageBus)
    {
    }

    public function dispatch(AbstractCommand $command): void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                /** @var Throwable $e */
                $e = $e->getPrevious();
            }
            throw $e;
        }
    }
}
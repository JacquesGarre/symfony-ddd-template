<?php

declare(strict_types=1);

namespace App\Domain\Shared;

interface CommandBusInterface
{
    public function dispatch(AbstractCommand $command): void;
}

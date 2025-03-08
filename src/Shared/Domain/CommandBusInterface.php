<?php

declare(strict_types=1);

namespace App\Shared\Domain;

interface CommandBusInterface {
    public function dispatch(AbstractCommand $command): void;
}
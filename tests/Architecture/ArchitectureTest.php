<?php

namespace App\Tests\Architecture;

use Exception;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
use DateTimeImmutable;

final class ArchitectureTest
{
    public function testDomainDoesNotDependOnOtherLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^App\\\\.+\\\\Domain$/', true))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('/^App\\\\.+\\\\Application$/', true),
                Selector::inNamespace('/^App\\\\.+\\\\Infrastructure$/', true),
            )
            ->because('Domain layer can not depend on other layers');
    }

    public function testDomainDoesNotDependOnVendors(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^App\\\\.+\\\\Domain$/', true))
            ->canOnlyDependOn()
            ->classes(
                Selector::inNamespace('/^App\\\\.+\\\\Domain$/', true),
                Selector::classname(Exception::class),
                Selector::classname(UuidInterface::class),
                Selector::classname(DateTimeImmutable::class),
                Selector::classname(Uuid::class)
            )
            ->because('Domain layer can not depend on vendors');
    }

    public function testApplicationDoesNotDependOnInfrastructureLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^App\\\\.+\\\\Application$/', true))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('/^App\\\\.+\\\\Infrastructure$/', true),
            )
            ->because('Application layer can not depend on infrastructure layer');
    }
}
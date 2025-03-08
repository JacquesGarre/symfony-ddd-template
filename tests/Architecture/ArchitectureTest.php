<?php

namespace App\Tests\Architecture;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class ArchitectureTest
{
    public function testDomainDoesNotDependOnOtherLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^App\\\\.+\\\\Domain/', true))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('/^App\\\\.+\\\\Application/', true),
                Selector::inNamespace('/^App\\\\.+\\\\Infrastructure/', true),
            )
            ->because('this will break DDD architecture');
    }

    public function testApplicationDoesNotDependOnInfrastructureLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^App\\\\.+\\\\Application/', true))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('/^App\\\\.+\\\\Infrastructure/', true),
            )
            ->because('this will break DDD architecture');
    }
}
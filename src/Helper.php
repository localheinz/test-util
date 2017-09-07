<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/test-util
 */

namespace Localheinz\Test\Util;

use Faker\Factory;
use Faker\Generator;

trait Helper
{
    final protected function faker(string $locale = Factory::DEFAULT_LOCALE): Generator
    {
        static $fakers = [];

        if (!\array_key_exists($locale, $fakers)) {
            $faker = Factory::create($locale);

            $faker->seed(9001);

            $fakers[$locale] = $faker;
        }

        return $fakers[$locale];
    }

    final protected function assertClassExists(string $className)
    {
        $this->assertTrue(\class_exists($className), \sprintf(
            'Failed to assert that a class "%s" exists',
            $className
        ));
    }

    final protected function assertClassImplementsInterface(string $interfaceName, string $className)
    {
        $this->assertInterfaceExists($interfaceName);
        $this->assertClassExists($className);

        $reflection = new \ReflectionClass($className);

        $this->assertTrue($reflection->implementsInterface($interfaceName), \sprintf(
            'Failed to assert that class "%s" implements interface "%s"',
            $className,
            $interfaceName
        ));
    }

    final protected function assertClassIsAbstractOrFinal(string $className)
    {
        $this->assertClassExists($className);

        $reflection = new \ReflectionClass($className);

        $this->assertTrue($reflection->isAbstract() || $reflection->isFinal(), \sprintf(
            'Failed to assert that class "%s" is abstract or final',
            $className
        ));
    }

    final protected function assertInterfaceExists(string $interfaceName)
    {
        $this->assertTrue(\interface_exists($interfaceName), \sprintf(
            'Failed to assert that an interface "%s" exists',
            $interfaceName
        ));
    }

    final protected function assertTraitExists(string $traitName)
    {
        $this->assertTrue(\trait_exists($traitName), \sprintf(
            'Failed to assert that a trait "%s" exists',
            $traitName
        ));
    }
}

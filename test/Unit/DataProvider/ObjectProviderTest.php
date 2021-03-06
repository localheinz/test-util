<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017-2021 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/test-util
 */

namespace Ergebnis\Test\Util\Test\Unit\DataProvider;

use Ergebnis\Test\Util\DataProvider\ObjectProvider;
use Ergebnis\Test\Util\Test\Util;

/**
 * @internal
 *
 * @covers \Ergebnis\Test\Util\DataProvider\ObjectProvider
 */
final class ObjectProviderTest extends AbstractProviderTestCase
{
    /**
     * @dataProvider \Ergebnis\Test\Util\DataProvider\ObjectProvider::object()
     *
     * @param mixed $value
     */
    public function testObjectProvidesObject($value): void
    {
        self::assertIsObject($value);
    }

    public function testObjectReturnsGeneratorThatProvidesObject(): void
    {
        $specifications = [
            'object' => Util\DataProvider\Specification\Equal::create(new \stdClass()),
        ];

        $provider = ObjectProvider::object();

        self::assertProvidesDataSetsForValuesSatisfyingSpecifications($specifications, $provider);
    }
}

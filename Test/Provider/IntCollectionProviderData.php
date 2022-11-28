<?php

declare(strict_types=1);

namespace Test\Provider;

use Generator;

final class IntCollectionProviderData
{
    public static function invalidData(): Generator
    {
        yield ['data' => [1]];
        yield ['data' => null];
        yield ['data' => true];
        yield ['data' => 1.1];
        yield ['data' => new \stdClass()];
        yield ['data' => 'str'];
    }
}

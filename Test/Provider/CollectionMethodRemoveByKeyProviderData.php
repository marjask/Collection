<?php

declare(strict_types=1);

namespace Test\Provider;

use Collection\ArrayCollection;
use Collection\BoolCollection;
use Collection\CallableCollection;
use Collection\DateTimeCollection;
use Collection\DoubleCollection;
use Collection\FloatCollection;
use Collection\IntCollection;
use Collection\NumericCollection;
use Collection\ObjectCollection;
use Collection\ResourceCollection;
use Collection\ScalarCollection;
use Collection\StringCollection;
use Generator;

final class CollectionMethodRemoveByKeyProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => new BoolCollection(),
            'element' => true,
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new CallableCollection(),
            'element' => static fn (callable $item): int => $item() * 3,
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new IntCollection(),
            'element' => 1,
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new ArrayCollection(),
            'element' => [1],
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new DateTimeCollection(),
            'element' => new \DateTime('now'),
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new DoubleCollection(),
            'element' => 1.1,
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new FloatCollection(),
            'element' => 1.1,
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new NumericCollection(),
            'element' => 1,
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new ObjectCollection(),
            'element' => new \stdClass(),
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new ResourceCollection(),
            'element' => fopen('php://memory', 'r'),
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new ScalarCollection(),
            'element' => 1,
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];

        yield [
            'collection' => new StringCollection(),
            'element' => 'string',
            'key' => 'phpunit',
            'keyUnassigned' => 'test',
        ];
    }
}

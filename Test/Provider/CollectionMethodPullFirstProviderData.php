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

final class CollectionMethodPullFirstProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => new BoolCollection(),
            'element' => true,
            'element2' => false,
        ];

        yield [
            'collection' => new CallableCollection(),
            'element' => static fn (callable $item): int => $item() * 3,
            'element2' => static fn (callable $item): int => $item() * 2,
        ];

        yield [
            'collection' => new IntCollection(),
            'element' => 1,
            'element2' => 2,
        ];

        yield [
            'collection' => new ArrayCollection(),
            'element' => [1],
            'element2' => [2],
        ];

        yield [
            'collection' => new DateTimeCollection(),
            'element' => new \DateTime('now'),
            'element2' => new \DateTime('+1day'),
        ];

        yield [
            'collection' => new DoubleCollection(),
            'element' => 1.1,
            'element2' => 2.2,
        ];

        yield [
            'collection' => new FloatCollection(),
            'element' => 1.1,
            'element2' => 2.2,
        ];

        yield [
            'collection' => new NumericCollection(),
            'element' => 1,
            'element2' => '2',
        ];

        yield [
            'collection' => new ObjectCollection(),
            'element' => new \stdClass(),
            'element2' => new \stdClass(),
        ];

        yield [
            'collection' => new ResourceCollection(),
            'element' => fopen('php://memory', 'r'),
            'element2' => fopen('php://memory', 'r'),
        ];

        yield [
            'collection' => new ScalarCollection(),
            'element' => 1,
            'element2' => 'string',
        ];

        yield [
            'collection' => new StringCollection(),
            'element' => 'string',
            'element2' => 'string 1',
        ];
    }
}

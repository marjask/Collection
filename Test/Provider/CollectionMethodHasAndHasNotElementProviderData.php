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

final class CollectionMethodHasAndHasNotElementProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => new BoolCollection(),
            'element' => true,
            'elementUnassigned' => false,
        ];

        yield [
            'collection' => new CallableCollection(),
            'element' => static fn (callable $item): int => $item() * 3,
            'elementUnassigned' => static fn (callable $item): int => $item() * 2,
        ];

        yield [
            'collection' => new IntCollection(),
            'element' => 1,
            'elementUnassigned' => 2,
        ];

        yield [
            'collection' => new ArrayCollection(),
            'element' => [1],
            'elementUnassigned' => [2],
        ];

        yield [
            'collection' => new DateTimeCollection(),
            'element' => new \DateTime('now'),
            'elementUnassigned' => new \DateTime('+1day'),
        ];

        yield [
            'collection' => new DoubleCollection(),
            'element' => 1.1,
            'elementUnassigned' => 2.2,
        ];

        yield [
            'collection' => new FloatCollection(),
            'element' => 1.1,
            'elementUnassigned' => 2.2,
        ];

        yield [
            'collection' => new NumericCollection(),
            'element' => 1,
            'elementUnassigned' => '2',
        ];

        yield [
            'collection' => new ObjectCollection(),
            'element' => new \stdClass(),
            'elementUnassigned' => new \stdClass(),
        ];

        yield [
            'collection' => new ResourceCollection(),
            'element' => fopen('php://memory', 'r'),
            'elementUnassigned' => fopen('php://memory', 'r'),
        ];

        yield [
            'collection' => new ScalarCollection(),
            'element' => 1,
            'elementUnassigned' => 'string',
        ];

        yield [
            'collection' => new StringCollection(),
            'element' => 'string',
            'elementUnassigned' => 'string 1',
        ];
    }
}

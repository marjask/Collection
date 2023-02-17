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

final class CollectionMethodMergeProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => new BoolCollection(),
            'collectionToMerge' => new BoolCollection(),
            'element' => true,
            'elementToMerge' => false,
        ];

        yield [
            'collection' => new CallableCollection(),
            'collectionToMerge' => new CallableCollection(),
            'element' => static fn (callable $item): int => $item() * 3,
            'elementToMerge' => static fn (callable $item): int => $item() * 2,
        ];

        yield [
            'collection' => new IntCollection(),
            'collectionToMerge' => new IntCollection(),
            'element' => 1,
            'elementToMerge' => 2,
        ];

        yield [
            'collection' => new ArrayCollection(),
            'collectionToMerge' => new ArrayCollection(),
            'element' => [1],
            'elementToMerge' => [2],
        ];

        yield [
            'collection' => new DateTimeCollection(),
            'collectionToMerge' => new DateTimeCollection(),
            'element' => new \DateTime('now'),
            'elementToMerge' => new \DateTime('+1day'),
        ];

        yield [
            'collection' => new DoubleCollection(),
            'collectionToMerge' => new DoubleCollection(),
            'element' => 1.1,
            'elementToMerge' => 2.2,
        ];

        yield [
            'collection' => new FloatCollection(),
            'collectionToMerge' => new FloatCollection(),
            'element' => 1.1,
            'elementToMerge' => 2.2,
        ];

        yield [
            'collection' => new NumericCollection(),
            'collectionToMerge' => new NumericCollection(),
            'element' => 1,
            'elementToMerge' => '2',
        ];

        yield [
            'collection' => new ObjectCollection(),
            'collectionToMerge' => new ObjectCollection(),
            'element' => new \stdClass(),
            'elementToMerge' => new \stdClass(),
        ];

        yield [
            'collection' => new ResourceCollection(),
            'collectionToMerge' => new ResourceCollection(),
            'element' => fopen('php://memory', 'r'),
            'elementToMerge' => fopen('php://memory', 'r'),
        ];

        yield [
            'collection' => new ScalarCollection(),
            'collectionToMerge' => new ScalarCollection(),
            'element' => 1,
            'elementToMerge' => 'string',
        ];

        yield [
            'collection' => new StringCollection(),
            'collectionToMerge' => new StringCollection(),
            'element' => 'string',
            'elementToMerge' => 'string 1',
        ];
    }

    public static function dataWithOverwrite(): Generator
    {
        yield [
            'collection' => new BoolCollection(),
            'collectionToMerge' => new BoolCollection(),
            'key' => 'key',
            'element' => true,
            'elementToMerge' => false,
        ];

        yield [
            'collection' => new CallableCollection(),
            'collectionToMerge' => new CallableCollection(),
            'key' => 'key',
            'element' => static fn (callable $item): int => $item() * 3,
            'elementToMerge' => static fn (callable $item): int => $item() * 2,
        ];

        yield [
            'collection' => new IntCollection(),
            'collectionToMerge' => new IntCollection(),
            'key' => 'key',
            'element' => 1,
            'elementToMerge' => 2,
        ];

        yield [
            'collection' => new ArrayCollection(),
            'collectionToMerge' => new ArrayCollection(),
            'key' => 'key',
            'element' => [1],
            'elementToMerge' => [2],
        ];

        yield [
            'collection' => new DateTimeCollection(),
            'collectionToMerge' => new DateTimeCollection(),
            'key' => 'key',
            'element' => new \DateTime('now'),
            'elementToMerge' => new \DateTime('+1day'),
        ];

        yield [
            'collection' => new DoubleCollection(),
            'collectionToMerge' => new DoubleCollection(),
            'key' => 'key',
            'element' => 1.1,
            'elementToMerge' => 2.2,
        ];

        yield [
            'collection' => new FloatCollection(),
            'collectionToMerge' => new FloatCollection(),
            'key' => 'key',
            'element' => 1.1,
            'elementToMerge' => 2.2,
        ];

        yield [
            'collection' => new NumericCollection(),
            'collectionToMerge' => new NumericCollection(),
            'key' => 'key',
            'element' => 1,
            'elementToMerge' => '2',
        ];

        yield [
            'collection' => new ObjectCollection(),
            'collectionToMerge' => new ObjectCollection(),
            'key' => 'key',
            'element' => new \stdClass(),
            'elementToMerge' => new \stdClass(),
        ];

        yield [
            'collection' => new ResourceCollection(),
            'collectionToMerge' => new ResourceCollection(),
            'key' => 'key',
            'element' => fopen('php://memory', 'r'),
            'elementToMerge' => fopen('php://memory', 'r'),
        ];

        yield [
            'collection' => new ScalarCollection(),
            'collectionToMerge' => new ScalarCollection(),
            'key' => 'key',
            'element' => 1,
            'elementToMerge' => 'string',
        ];

        yield [
            'collection' => new StringCollection(),
            'collectionToMerge' => new StringCollection(),
            'key' => 'key',
            'element' => 'string',
            'elementToMerge' => 'string 1',
        ];
    }
}

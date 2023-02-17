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

final class CollectionMethodIsNotEmptyProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => new BoolCollection(),
            'element' => true,
        ];

        yield [
            'collection' => new CallableCollection(),
            'element' => static fn() => null,
        ];

        yield [
            'collection' => new IntCollection(),
            'element' => 1,
        ];

        yield [
            'collection' => new ArrayCollection(),
            'element' => [2],
        ];


        yield [
            'collection' => new DateTimeCollection(),
            'element' => new \DateTime(),
        ];

        yield [
            'collection' => new DoubleCollection(),
            'element' => 1.1,
        ];

        yield [
            'collection' => new FloatCollection(),
            'element' => 1.2,
        ];

        yield [
            'collection' => new NumericCollection(),
            'element' => '2.2',
        ];

        yield [
            'collection' => new ObjectCollection(),
            'element' => new \stdClass(),
        ];

        yield [
            'collection' => new ResourceCollection(),
            'element' => \fopen('php://memory', 'r'),
        ];

        yield [
            'collection' => new ScalarCollection(),
            'element' => true,
        ];

        yield [
            'collection' => new StringCollection(),
            'element' => 'string',
        ];
    }
}

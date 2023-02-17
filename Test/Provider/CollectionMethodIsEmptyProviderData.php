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

final class CollectionMethodIsEmptyProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => new BoolCollection(),
        ];

        yield [
            'collection' => new CallableCollection(),
        ];

        yield [
            'collection' => new IntCollection(),
        ];

        yield [
            'collection' => new ArrayCollection(),
        ];

        yield [
            'collection' => new ArrayCollection(),
        ];

        yield [
            'collection' => new DateTimeCollection(),
        ];

        yield [
            'collection' => new DoubleCollection(),
        ];

        yield [
            'collection' => new FloatCollection(),
        ];

        yield [
            'collection' => new NumericCollection(),
        ];

        yield [
            'collection' => new ObjectCollection(),
        ];

        yield [
            'collection' => new ResourceCollection(),
        ];

        yield [
            'collection' => new ScalarCollection(),
        ];

        yield [
            'collection' => new StringCollection(),
        ];
    }
}

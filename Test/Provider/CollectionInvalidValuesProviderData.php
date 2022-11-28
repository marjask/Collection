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

final class CollectionInvalidValuesProviderData
{
    public static function invalidData(): Generator
    {
        yield [
            'class' => ArrayCollection::class,
            'data' => true,
        ];
        yield [
            'class' => ArrayCollection::class,
            'data' => null,
        ];
        yield [
            'class' => ArrayCollection::class,
            'data' => 10,
        ];
        yield [
            'class' => ArrayCollection::class,
            'data' => 1.1,
        ];
        yield [
            'class' => ArrayCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => ArrayCollection::class,
            'data' => 'str',
        ];

        yield [
            'class' => BoolCollection::class,
            'data' => [1],
        ];
        yield [
            'class' => BoolCollection::class,
            'data' => null,
        ];
        yield [
            'class' => BoolCollection::class,
            'data' => 10,
        ];
        yield [
            'class' => BoolCollection::class,
            'data' => 1.1,
        ];
        yield [
            'class' => BoolCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => BoolCollection::class,
            'data' => 'str',
        ];

        yield [
            'class' => CallableCollection::class,
            'data' => [1],
        ];
        yield [
            'class' => CallableCollection::class,
            'data' => null,
        ];
        yield [
            'class' => CallableCollection::class,
            'data' => 10,
        ];
        yield [
            'class' => CallableCollection::class,
            'data' => 1.1,
        ];
        yield [
            'class' => CallableCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => CallableCollection::class,
            'data' => 'str',
        ];
        yield [
            'class' => CallableCollection::class,
            'data' => new \DateTime(),
        ];
        yield [
            'class' => CallableCollection::class,
            'data' => true,
        ];

        yield [
            'class' => DateTimeCollection::class,
            'data' => true,
        ];
        yield [
            'class' => DateTimeCollection::class,
            'data' => null,
        ];
        yield [
            'class' => DateTimeCollection::class,
            'data' => 10,
        ];
        yield [
            'class' => DateTimeCollection::class,
            'data' => 1.1,
        ];
        yield [
            'class' => DateTimeCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => DateTimeCollection::class,
            'data' => '2022-11-22',
        ];
        yield [
            'class' => DateTimeCollection::class,
            'data' => ['2022-11-22'],
        ];

        yield [
            'class' => DoubleCollection::class,
            'data' => true,
        ];
        yield [
            'class' => DoubleCollection::class,
            'data' => null,
        ];
        yield [
            'class' => DoubleCollection::class,
            'data' => [10],
        ];
        yield [
            'class' => DoubleCollection::class,
            'data' => 1,
        ];
        yield [
            'class' => DoubleCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => DoubleCollection::class,
            'data' => '1.1',
        ];

        yield [
            'class' => FloatCollection::class,
            'data' => true,
        ];
        yield [
            'class' => FloatCollection::class,
            'data' => null,
        ];
        yield [
            'class' => FloatCollection::class,
            'data' => [10],
        ];
        yield [
            'class' => FloatCollection::class,
            'data' => 1,
        ];
        yield [
            'class' => FloatCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => FloatCollection::class,
            'data' => '1.1',
        ];

        yield [
            'class' => IntCollection::class,
            'data' => true,
        ];
        yield [
            'class' => IntCollection::class,
            'data' => null,
        ];
        yield [
            'class' => IntCollection::class,
            'data' => [10],
        ];
        yield [
            'class' => IntCollection::class,
            'data' => 1.1,
        ];
        yield [
            'class' => IntCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => IntCollection::class,
            'data' => 'str',
        ];

        yield [
            'class' => NumericCollection::class,
            'data' => true,
        ];
        yield [
            'class' => NumericCollection::class,
            'data' => null,
        ];
        yield [
            'class' => NumericCollection::class,
            'data' => [10],
        ];
        yield [
            'class' => NumericCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => NumericCollection::class,
            'data' => 'str',
        ];

        yield [
            'class' => ObjectCollection::class,
            'data' => true,
        ];
        yield [
            'class' => ObjectCollection::class,
            'data' => null,
        ];
        yield [
            'class' => ObjectCollection::class,
            'data' => 10,
        ];
        yield [
            'class' => ObjectCollection::class,
            'data' => 1.1,
        ];
        yield [
            'class' => ObjectCollection::class,
            'data' => 'str',
        ];
        yield [
            'class' => ObjectCollection::class,
            'data' => [new \stdClass()],
        ];

        yield [
            'class' => ResourceCollection::class,
            'data' => true,
        ];
        yield [
            'class' => ResourceCollection::class,
            'data' => null,
        ];
        yield [
            'class' => ResourceCollection::class,
            'data' => [10],
        ];
        yield [
            'class' => ResourceCollection::class,
            'data' => 1,
        ];
        yield [
            'class' => ResourceCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => ResourceCollection::class,
            'data' => 1.1,
        ];
        yield [
            'class' => ResourceCollection::class,
            'data' => 'test',
        ];

        yield [
            'class' => ScalarCollection::class,
            'data' => null,
        ];
        yield [
            'class' => ScalarCollection::class,
            'data' => [10],
        ];
        yield [
            'class' => ScalarCollection::class,
            'data' => new \stdClass(),
        ];

        yield [
            'class' => StringCollection::class,
            'data' => true,
        ];
        yield [
            'class' => StringCollection::class,
            'data' => null,
        ];
        yield [
            'class' => StringCollection::class,
            'data' => [10],
        ];
        yield [
            'class' => StringCollection::class,
            'data' => 1,
        ];
        yield [
            'class' => StringCollection::class,
            'data' => new \stdClass(),
        ];
        yield [
            'class' => StringCollection::class,
            'data' => 1.1,
        ];
    }
}

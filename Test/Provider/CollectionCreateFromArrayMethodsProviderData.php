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

final class CollectionCreateFromArrayMethodsProviderData
{
    public static function staticCreateFromArrayData(): Generator
    {
        $arrayElement1 = [
            'element' => true,
            'test' => false,
        ];
        $arrayElement2 = [
            'phpunit' => 2,
            'testcase' => '123123',
        ];
        $arrayElement3 = [
            'phpunit' => 1,
            'test' => '123',
        ];
        yield [
            'data' => [
                $arrayElement1,
                $arrayElement2,
                $arrayElement3,
            ],
            'expectedFirstElement' => $arrayElement1,
            'expectedLastElement' => $arrayElement3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $arrayElement2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => ['unassignedElement'],
            'class' => ArrayCollection::class,
            'count' => 3,
        ];
        yield [
            'data' => [
                true,
                false,
            ],
            'expectedFirstElement' => true,
            'expectedLastElement' => false,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => false,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => BoolCollection::class,
            'count' => 2,
        ];

        $callback1 = static function () {
            return 1;
        };
        $callback2 = static function () {
            return 2;
        };

        yield [
            'data' => [
                $callback1,
                $callback2,
            ],
            'expectedFirstElement' => $callback1,
            'expectedLastElement' => $callback2,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $callback2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => CallableCollection::class,
            'count' => 2,
        ];

        $datetime1 = new \DateTime('2022-01-01');
        $datetime2 = new \DateTime('2022-01-02');
        $datetime3 = new \DateTime('2022-01-03');

        yield [
            'data' => [
                $datetime1,
                $datetime2,
                $datetime3,
            ],
            'expectedFirstElement' => $datetime1,
            'expectedLastElement' => $datetime3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $datetime2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => DateTimeCollection::class,
            'count' => 3,
        ];

        $double1 = 1.1;
        $double2 = 2.2;
        $double3 = 3.3;

        yield [
            'data' => [
                $double1,
                $double2,
                $double3,
            ],
            'expectedFirstElement' => $double1,
            'expectedLastElement' => $double3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $double2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => DoubleCollection::class,
            'count' => 3,
        ];

        $float1 = 3.1;
        $float2 = 1.2;
        $float3 = 2.3;

        yield [
            'data' => [
                $float1,
                $float2,
                $float3,
            ],
            'expectedFirstElement' => $float1,
            'expectedLastElement' => $float3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $float2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => FloatCollection::class,
            'count' => 3,
        ];
        yield [
            'data' => [
                -1,
                2,
                3,
            ],
            'expectedFirstElement' => -1,
            'expectedLastElement' => 3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => 2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => IntCollection::class,
            'count' => 3,
        ];

        $numeric1 = -1;
        $numeric2 = 2;
        $numeric3 = '3';
        $numeric4 = '5.1';
        $numeric5 = ' 3 ';
        yield [
            'data' => [
                $numeric1,
                $numeric2,
                $numeric3,
                $numeric4,
                $numeric5,
            ],
            'expectedFirstElement' => $numeric1,
            'expectedLastElement' => $numeric5,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $numeric2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => NumericCollection::class,
            'count' => 5,
        ];

        $object1 = new \stdClass();
        $object2 = new \DateTime();
        $object3 = new \DateTimeImmutable();
        yield [
            'data' => [
                $object1,
                $object2,
                $object3,
            ],
            'expectedFirstElement' => $object1,
            'expectedLastElement' => $object3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $object2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => ObjectCollection::class,
            'count' => 3,
        ];

        $resource1 = fopen('php://stdout', 'w');
        $resource2 = fopen('php://stdout', 'w');
        $resource3 = fopen('php://stdout', 'w');
        yield [
            'data' => [
                $resource1,
                $resource2,
                $resource3,
            ],
            'expectedFirstElement' => $resource1,
            'expectedLastElement' => $resource3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $resource2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => ResourceCollection::class,
            'count' => 3,
        ];

        $scalar1 = 1;
        $scalar2 = 1.1;
        $scalar3 = 'test';
        $scalar4 = false;
        yield [
            'data' => [
                $scalar1,
                $scalar2,
                $scalar3,
                $scalar4,
            ],
            'expectedFirstElement' => $scalar1,
            'expectedLastElement' => $scalar4,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $scalar2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => ScalarCollection::class,
            'count' => 4,
        ];

        $string1 = 'test1';
        $string2 = 'test2';
        $string3 = 'test3';
        yield [
            'data' => [
                $string1,
                $string2,
                $string3,
            ],
            'expectedFirstElement' => $string1,
            'expectedLastElement' => $string3,
            'nameKeySecondElement' => 1,
            'expectedSecondElement' => $string2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => StringCollection::class,
            'count' => 3,
        ];
    }

    public static function staticCreateFromStaticArrayData(): Generator
    {
        $arrayElement1 = [
            'element' => true,
            'test' => false,
        ];
        $arrayElement2 = [
            'phpunit' => 2,
            'testcase' => '123123',
        ];
        $arrayElement3 = [
            'phpunit' => 1,
            'test' => '123',
        ];
        yield [
            'data' => [
                'first' => $arrayElement1,
                'second' => $arrayElement2,
                'third' => $arrayElement3,
            ],
            'expectedFirstElement' => $arrayElement1,
            'expectedLastElement' => $arrayElement3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $arrayElement2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => ['unassignedElement'],
            'class' => ArrayCollection::class,
            'count' => 3,
        ];
        yield [
            'data' => [
                'first' => true,
                'second' => false,
            ],
            'expectedFirstElement' => true,
            'expectedLastElement' => false,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => false,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => BoolCollection::class,
            'count' => 2,
        ];

        $callback1 = static function () {
            return 1;
        };
        $callback2 = static function () {
            return 2;
        };

        yield [
            'data' => [
                'first' => $callback1,
                'second' => $callback2,
            ],
            'expectedFirstElement' => $callback1,
            'expectedLastElement' => $callback2,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $callback2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => CallableCollection::class,
            'count' => 2,
        ];

        $datetime1 = new \DateTime('2022-01-01');
        $datetime2 = new \DateTime('2022-01-02');
        $datetime3 = new \DateTime('2022-01-03');

        yield [
            'data' => [
                'first' => $datetime1,
                'second' => $datetime2,
                'third' => $datetime3,
            ],
            'expectedFirstElement' => $datetime1,
            'expectedLastElement' => $datetime3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $datetime2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => DateTimeCollection::class,
            'count' => 3,
        ];

        $double1 = 1.1;
        $double2 = 2.2;
        $double3 = 3.3;

        yield [
            'data' => [
                'first' => $double1,
                'second' => $double2,
                'third' => $double3,
            ],
            'expectedFirstElement' => $double1,
            'expectedLastElement' => $double3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $double2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => DoubleCollection::class,
            'count' => 3,
        ];

        $float1 = 3.1;
        $float2 = 1.2;
        $float3 = 2.3;

        yield [
            'data' => [
                'first' => $float1,
                'second' => $float2,
                'third' => $float3,
            ],
            'expectedFirstElement' => $float1,
            'expectedLastElement' => $float3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $float2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => FloatCollection::class,
            'count' => 3,
        ];
        yield [
            'data' => [
                'first' => -1,
                'second' => 2,
                'third' => 3,
            ],
            'expectedFirstElement' => -1,
            'expectedLastElement' => 3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => 2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => IntCollection::class,
            'count' => 3,
        ];

        $numeric1 = -1;
        $numeric2 = 2;
        $numeric3 = '3';
        $numeric4 = '5.1';
        $numeric5 = ' 3 ';
        yield [
            'data' => [
                'first' => $numeric1,
                'second' => $numeric2,
                'third' => $numeric3,
                'fourth' => $numeric4,
                'fifth' => $numeric5,
            ],
            'expectedFirstElement' => $numeric1,
            'expectedLastElement' => $numeric5,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $numeric2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => NumericCollection::class,
            'count' => 5,
        ];

        $object1 = new \stdClass();
        $object2 = new \DateTime();
        $object3 = new \DateTimeImmutable();
        yield [
            'data' => [
                'first' => $object1,
                'second' => $object2,
                'third' => $object3,
            ],
            'expectedFirstElement' => $object1,
            'expectedLastElement' => $object3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $object2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => ObjectCollection::class,
            'count' => 3,
        ];

        $resource1 = fopen('php://stdout', 'w');
        $resource2 = fopen('php://stdout', 'w');
        $resource3 = fopen('php://stdout', 'w');
        yield [
            'data' => [
                'first' => $resource1,
                'second' => $resource2,
                'third' => $resource3,
            ],
            'expectedFirstElement' => $resource1,
            'expectedLastElement' => $resource3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $resource2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => ResourceCollection::class,
            'count' => 3,
        ];

        $scalar1 = 1;
        $scalar2 = 1.1;
        $scalar3 = 'test';
        $scalar4 = false;
        yield [
            'data' => [
                'first' => $scalar1,
                'second' => $scalar2,
                'third' => $scalar3,
                'fourth' => $scalar4,
            ],
            'expectedFirstElement' => $scalar1,
            'expectedLastElement' => $scalar4,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $scalar2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => ScalarCollection::class,
            'count' => 4,
        ];

        $string1 = 'test1';
        $string2 = 'test2';
        $string3 = 'test3';
        yield [
            'data' => [
                'first' => $string1,
                'second' => $string2,
                'third' => $string3,
            ],
            'expectedFirstElement' => $string1,
            'expectedLastElement' => $string3,
            'nameKeySecondElement' => 'second',
            'expectedSecondElement' => $string2,
            'unassignedKeyElement' => 99,
            'unassignedElement' => 'unassignedElement',
            'class' => StringCollection::class,
            'count' => 3,
        ];
    }
}

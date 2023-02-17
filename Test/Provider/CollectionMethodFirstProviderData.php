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

final class CollectionMethodFirstProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => (new BoolCollection())
                ->add(true)
                ->add(false)
                ->add(true),
            'expected' => true,
        ];

        $fn = static function(): int {
            return 1;
        };
        yield [
            'collection' => (new CallableCollection())
                ->add($fn)
                ->add(static function(): int {
                    return 2;
                })
                ->add(static function(): int {
                    return 3;
                }),
            'expected' => $fn,
        ];

        yield [
            'collection' => (new IntCollection())
                ->add(1)
                ->add(7),
            'expected' => 1,
        ];

        yield [
            'collection' => (new ArrayCollection())
                ->add([1,4,8])
                ->add([2,7,9]),
            'expected' => [1,4,8],
        ];

        $dateTime = new \DateTime('2021-01-01');
        yield [
            'collection' => (new DateTimeCollection())
                ->add($dateTime)
                ->add(new \DateTime('2022-01-01'))
                ->add(new \DateTime('2023-01-01')),
            'expected' => $dateTime,
        ];

        yield [
            'collection' => (new DoubleCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => 1.2,
        ];

        yield [
            'collection' => (new FloatCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => 1.2,
        ];

        yield [
            'collection' => (new NumericCollection())
                ->add(1.2)
                ->add('54')
                ->add(-1),
            'expected' => 1.2,
        ];

        $stdClass = (object) ['phpunit' => true];
        yield [
            'collection' => (new ObjectCollection())
                ->add($stdClass)
                ->add((object) ['phpunit' => 1])
                ->add(new \DateTime('now')),
            'expected' => $stdClass,
        ];

        $handle = fopen('php://stdout', 'w');
        yield [
            'collection' => (new ResourceCollection())
                ->add($handle)
                ->add(opendir('/')),
            'expected' => $handle,
        ];

        yield [
            'collection' => (new ScalarCollection())
                ->add(1)
                ->add(1.1)
                ->add(true)
                ->add('string'),
            'expected' => 1,
        ];

        yield [
            'collection' => (new StringCollection())
                ->add('string string')
                ->add('string string test')
                ->add('string string test test'),
            'expected' => 'string string',
        ];
    }
}

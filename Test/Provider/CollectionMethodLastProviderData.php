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

final class CollectionMethodLastProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => (new BoolCollection())
                ->add(true)
                ->add(false)
                ->add(false),
            'expected' => false,
        ];

        yield [
            'collection' => (new CallableCollection())
                ->add(static function(): int {
                    return 1;
                })
                ->add(static function(): int {
                    return 2;
                })
                ->add(static function(): int {
                    return 3;
                }),
            'expected' => static function(): int {
                return 3;
            },
        ];

        yield [
            'collection' => (new IntCollection())
                ->add(1)
                ->add(7),
            'expected' => 7,
        ];

        yield [
            'collection' => (new ArrayCollection())
                ->add([1,4,8])
                ->add([2,7,9]),
            'expected' => [2,7,9],
        ];

        $dateTime = new \DateTime('2021-01-01');
        yield [
            'collection' => (new DateTimeCollection())
                ->add(new \DateTime('2022-01-01'))
                ->add(new \DateTime('2023-01-01'))
                ->add($dateTime),
            'expected' => $dateTime,
        ];

        yield [
            'collection' => (new DoubleCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => 12.3,
        ];

        yield [
            'collection' => (new FloatCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => 12.3,
        ];

        yield [
            'collection' => (new NumericCollection())
                ->add(1.2)
                ->add('54')
                ->add(-1),
            'expected' => -1,
        ];

        $stdClass = (object) ['phpunit' => true];
        yield [
            'collection' => (new ObjectCollection())
                ->add((object) ['phpunit' => 1])
                ->add(new \DateTime('now'))
                ->add($stdClass),
            'expected' => $stdClass,
        ];

        $handle = fopen('php://stdout', 'w');
        yield [
            'collection' => (new ResourceCollection())
                ->add(opendir('/'))
                ->add($handle),
            'expected' => $handle,
        ];

        yield [
            'collection' => (new ScalarCollection())
                ->add(1)
                ->add(1.1)
                ->add(true)
                ->add('string'),
            'expected' => 'string',
        ];

        yield [
            'collection' => (new StringCollection())
                ->add('string string')
                ->add('string string test')
                ->add('string string test test'),
            'expected' => 'string string test test',
        ];
    }
}

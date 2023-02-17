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

final class CollectionMethodColumnProviderData
{
    public static function dataForException(): Generator
    {
        yield [
            'collection' => (new BoolCollection())
                ->add(true)
                ->add(true)
                ->add(false),
            'column' => 'column',
        ];

        yield [
            'collection' => (new CallableCollection())
                ->add(static function(): int {
                    return 1;
                })
                ->add(static function(): string {
                    return '2';
                })
                ->add(static function(): int {
                    return 3;
                }),
            'column' => 'column',
        ];

        yield [
            'collection' => (new IntCollection())
                ->add(1)
                ->add(7),
            'column' => 'column',
        ];

        yield [
            'collection' => (new DateTimeCollection())
                ->add(new \DateTime('2022-10-11'))
                ->add(new \DateTime('2022-11-11'))
                ->add(new \DateTime('2022-10-13')),
            'column' => 'column',
        ];

        yield [
            'collection' => (new DoubleCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'column' => 'column',
        ];

        yield [
            'collection' => (new FloatCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'column' => 'column',
        ];

        yield [
            'collection' => (new NumericCollection())
                ->add(1.2)
                ->add('54')
                ->add(-1),
            'column' => 'column',
        ];

        yield [
            'collection' => (new ObjectCollection())
                ->add((object) ['phpunit' => true])
                ->add((object) ['phpunit' => 1])
                ->add(new \DateTime('now')),
            'column' => 'phpunit',
        ];

        yield [
            'collection' => (new ResourceCollection())
                ->add(fopen('php://stdout', 'w'))
                ->add(opendir('/')),
            'column' => 'column',
        ];

        yield [
            'collection' => (new ScalarCollection())
                ->add(1)
                ->add(1.1)
                ->add(true)
                ->add('string'),
            'column' => 'column',
        ];

        yield [
            'collection' => (new StringCollection())
                ->add('string string')
                ->add('string string test')
                ->add('string string test test'),
            'column' => 'column',
        ];
    }

    public static function validData(): \Generator
    {
        yield [
            'collection' => (new ArrayCollection())
                ->add([1,4,8])
                ->add([2,7,9]),
            'column' => 0,
            'expected' => [1,2],
        ];

        yield [
            'collection' => (new ArrayCollection())
                ->add([
                    'key1' => 1,
                    'key2' => 4,
                    'key3' => 8
                ])
                ->add([
                    'key1' => 2,
                    'key2' => 7,
                    'key3' => 9
                ]),
            'column' => 'key1',
            'expected' => [1,2],
        ];

        yield [
            'collection' => (new ObjectCollection())
                ->add((object) ['phpunit' => true])
                ->add((object) ['phpunit' => 1]),
            'column' => 'phpunit',
            'expected' => [true, 1],
        ];
    }
}

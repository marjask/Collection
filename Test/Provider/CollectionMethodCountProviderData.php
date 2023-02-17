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

final class CollectionMethodCountProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => (new BoolCollection())
                ->add(true)
                ->add(true)
                ->add(false),
            'expectedCount' => 3,
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
            'expectedCount' => 3,
        ];

        yield [
            'collection' => (new IntCollection())
                ->add(1)
                ->add(7),
            'expectedCount' => 2,
        ];

        yield [
            'collection' => (new ArrayCollection())
                ->add([1,4,8])
                ->add([2,7,9]),
            'expectedCount' => 2,
        ];

        yield [
            'collection' => (new ArrayCollection())
                ->add([1,4,8])
                ->add([2,7,9]),
            'expectedCount' => 2,
        ];

        yield [
            'collection' => (new DateTimeCollection())
                ->add(new \DateTime('2022-10-11'))
                ->add(new \DateTime('2022-11-11'))
                ->add(new \DateTime('2022-10-13')),
            'expectedCount' => 3,
        ];

        yield [
            'collection' => (new DoubleCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expectedCount' => 3,
        ];

        yield [
            'collection' => (new FloatCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expectedCount' => 3,
        ];

        yield [
            'collection' => (new NumericCollection())
                ->add(1.2)
                ->add('54')
                ->add(-1),
            'expectedCount' => 3,
        ];

        yield [
            'collection' => (new ObjectCollection())
                ->add((object) ['phpunit' => true])
                ->add((object) ['phpunit' => 1])
                ->add(new \DateTime('now')),
            'expectedCount' => 3,
        ];

        yield [
            'collection' => (new ResourceCollection())
                ->add(fopen('php://stdout', 'w'))
                ->add(opendir('/')),
            'expectedCount' => 2,
        ];

        yield [
            'collection' => (new ScalarCollection())
                ->add(1)
                ->add(1.1)
                ->add(true)
                ->add('string'),
            'expectedCount' => 4,
        ];

        yield [
            'collection' => (new StringCollection())
                ->add('string string')
                ->add('string string test')
                ->add('string string test test'),
            'expectedCount' => 3,
        ];
    }
}

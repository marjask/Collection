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

final class CollectionMethodMapProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => (new BoolCollection())
                ->add(true)
                ->add(false)
                ->add(true),
            'expected' => [false, true, false],
            'filter' => static fn (bool $item): bool => !$item,
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
            'expected' => [3, 6, 9],
            'filter' => static fn (callable $item): int => $item() * 3,
        ];

        yield [
            'collection' => (new IntCollection())
                ->add(1)
                ->add(7),
            'expected' => [2, 8],
            'filter' => static fn (int $item): int => $item + 1,
        ];

        yield [
            'collection' => (new ArrayCollection())
                ->add([1,4,8])
                ->add([2,7,9]),
            'expected' => [13, 18],
            'filter' => static fn (array $item): float|int => array_sum($item),
        ];

        yield [
            'collection' => (new DateTimeCollection())
                ->add(new \DateTime('2021-01-01'))
                ->add(new \DateTime('2022-01-01'))
                ->add(new \DateTime('2023-01-01')),
            'expected' => ['2021', '2022', '2023'],
            'fn' => static fn (\DateTime $dateTime): string => $dateTime->format('Y'),
        ];

        yield [
            'collection' => (new DoubleCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => [2.4, 109.0, 24.6],
            'fn' => static fn (float $float): float => $float * 2,
        ];

        yield [
            'collection' => (new FloatCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => [2.4, 109.0, 24.6],
            'fn' => static fn (float $float): float => $float * 2,
        ];

        yield [
            'collection' => (new NumericCollection())
                ->add(1.2)
                ->add('54')
                ->add(-1),
            'expected' => [2.4, 108, -2],
            'fn' => static fn (mixed $numeric): mixed => $numeric * 2,
        ];

        yield [
            'collection' => (new ObjectCollection())
                ->add((object) ['phpunit' => true])
                ->add((object) ['phpunit' => 1])
                ->add(new \DateTime('now')),
            'expected' => [false, false, true],
            'fn' => static fn (object $object): bool => $object instanceof \DateTime,
        ];

        yield [
            'collection' => (new ResourceCollection())
                ->add(fopen('php://stdout', 'w'))
                ->add(opendir('/')),
            'expected' => [true, true],
            'fn' => static fn ($resource): bool => get_resource_type($resource) === 'stream',
        ];

        yield [
            'collection' => (new ScalarCollection())
                ->add(1)
                ->add(1.1)
                ->add(true)
                ->add('string'),
            'expected' => [true, false, false, false],
            'fn' => static fn (mixed $scalar): bool => is_int($scalar),
        ];

        yield [
            'collection' => (new StringCollection())
                ->add('string string')
                ->add('string string test')
                ->add('string string test test'),
            'expected' => ['string s', 'string s', 'string s'],
            'fn' => static fn (string $string): string => substr($string, 0, 8),
        ];
    }
}

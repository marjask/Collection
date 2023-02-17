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

final class CollectionMethodReduceProviderData
{
    public static function data(): Generator
    {
        yield [
            'collection' => (new BoolCollection())
                ->add(true)
                ->add(true)
                ->add(false),
            'expected' => false,
            'filter' => static fn (?bool $curry, bool $item): bool => is_bool($curry) ? $curry && $item : $item,
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
            'expected' => 6,
            'filter' => static fn (?int $curry, callable $item): int => $item() + $curry,
        ];

        yield [
            'collection' => (new IntCollection())
                ->add(1)
                ->add(7)
                ->add(5),
            'expected' => 13,
            'filter' => static fn (?int $curry, int $item): int => $item + $curry,
        ];

        yield [
            'collection' => (new ArrayCollection())
                ->add([1,4,8])
                ->add([2,7,9]),
            'expected' => 31,
            'filter' => static fn (?int $curry, array $item): int|float => array_sum($item) + $curry,
        ];

        yield [
            'collection' => (new DateTimeCollection())
                ->add(new \DateTime('2022-10-11'))
                ->add(new \DateTime('2022-11-11'))
                ->add(new \DateTime('2022-10-13')),
            'expected' => 31,
            'fn' => static fn (?int $curry, \DateTime $item): int => (int)$item->format('m') + $curry,
        ];

        yield [
            'collection' => (new DoubleCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => 68.0,
            'fn' => static fn (?float $curry, float $item): float => $item + $curry,
        ];

        yield [
            'collection' => (new FloatCollection())
                ->add(1.2)
                ->add(54.5)
                ->add(12.3),
            'expected' => 68.0,
            'fn' => static fn (?float $curry, float $item): float => $item + $curry,
        ];

        yield [
            'collection' => (new NumericCollection())
                ->add(1.2)
                ->add('54')
                ->add(-1),
            'expected' => 54.2,
            'fn' => static fn ($curry, $item) => $item + $curry,
        ];

        yield [
            'collection' => (new ObjectCollection())
                ->add((object) ['phpunit' => true])
                ->add((object) ['phpunit' => 1])
                ->add(new \DateTime('now')),
            'expected' => 2,
            'fn' => static fn (?int $curry, object $item): int|null => property_exists($item, 'phpunit') ? $curry + 1 : $curry,
        ];

        yield [
            'collection' => (new ResourceCollection())
                ->add(fopen('php://stdout', 'w'))
                ->add(opendir('/')),
            'expected' => 2,
            'fn' => static fn (?int $curry, $resource): int|null => get_resource_type($resource) === 'stream' ? $curry + 1 : $curry,
        ];

        yield [
            'collection' => (new ScalarCollection())
                ->add(1)
                ->add(1.1)
                ->add(true)
                ->add('string'),
            'expected' => 1,
            'fn' => static fn (?int $curry, mixed $scalar): int|null => is_int($scalar) ? $curry + 1 : $curry,
        ];

        yield [
            'collection' => (new StringCollection())
                ->add('string string')
                ->add('string string test')
                ->add('string string test test'),
            'expected' => 54,
            'fn' => static fn (?int $curry, string $string): int => strlen($string) + $curry,
        ];
    }
}

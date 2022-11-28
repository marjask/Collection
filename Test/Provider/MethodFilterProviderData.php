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

final class MethodFilterProviderData
{
    public static function data(): Generator
    {
        yield [
            'class' => ArrayCollection::class,
            'elements' => [
                [1,4,8],
                [2,7,9],
            ],
            'expectedCount' => 1,
            'fn' => static fn (array $item): bool => array_sum($item) > 15,
        ];

        yield [
            'class' => ArrayCollection::class,
            'elements' => [
                [1,4,8],
                [2,7,9],
            ],
            'expectedCount' => 0,
            'fn' => static fn (array $item): bool => array_sum($item) > 55,
        ];

        yield [
            'class' => BoolCollection::class,
            'elements' => [true,false,true],
            'expectedCount' => 2,
            'fn' => static fn (bool $item): bool => $item === true,
        ];

        yield [
            'class' => CallableCollection::class,
            'elements' => [
                static fn (): bool => true,
                static fn (): bool => false,
                static fn () => null,
                static fn (): int => 1,
            ],
            'expectedCount' => 4,
            'fn' => static fn (callable $fn): bool => is_callable($fn),
        ];

        yield [
            'class' => DateTimeCollection::class,
            'elements' => [
                new \DateTime('2022-10-11'),
                new \DateTime('2022-11-11'),
                new \DateTime('2022-10-13'),
            ],
            'expectedCount' => 2,
            'fn' => static fn (\DateTime $dateTime): bool => $dateTime->format('m') === '10',
        ];

        yield [
            'class' => DoubleCollection::class,
            'elements' => [
                1.2,
                54.5,
                12.3,
            ],
            'expectedCount' => 2,
            'fn' => static fn (float $float): bool => $float > 10,
        ];

        yield [
            'class' => FloatCollection::class,
            'elements' => [
                1.2,
                54.5,
                12.3,
            ],
            'expectedCount' => 2,
            'fn' => static fn (float $float): bool => $float > 10,
        ];

        yield [
            'class' => IntCollection::class,
            'elements' => [1,7],
            'expectedCount' => 1,
            'fn' => static fn (int $item): bool => $item < 5,
        ];

        yield [
            'class' => IntCollection::class,
            'elements' => [1,7],
            'expectedCount' => 2,
            'fn' => static fn (int $item): bool => $item > 0,
        ];

        yield [
            'class' => NumericCollection::class,
            'elements' => [
                1.2,
                '54',
                -1,
            ],
            'expectedCount' => 1,
            'fn' => static fn ($numeric): bool => $numeric < 0,
        ];

        yield [
            'class' => ObjectCollection::class,
            'elements' => [
                (object) ['phpunit' => true],
                (object) ['phpunit' => 1],
                new \DateTime('now'),
            ],
            'expectedCount' => 1,
            'fn' => static fn (object $object): bool => property_exists($object, 'phpunit') && $object->phpunit === true,
        ];

        yield [
            'class' => ResourceCollection::class,
            'elements' => [
                fopen('php://stdout', 'w'),
                opendir('/'),
            ],
            'expectedCount' => 2,
            'fn' => static fn ($resource): bool => get_resource_type($resource) === 'stream',
        ];

        yield [
            'class' => ScalarCollection::class,
            'elements' => [1, 1.1, true, 'string'],
            'expectedCount' => 1,
            'fn' => static fn (mixed $scalar): bool => is_int($scalar),
        ];

        yield [
            'class' => StringCollection::class,
            'elements' => [
                'string string',
                'string string test',
                'string string test test',
            ],
            'expectedCount' => 1,
            'fn' => static fn (string $string): bool => strlen($string) < 15,
        ];
    }
}

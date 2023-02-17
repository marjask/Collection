<?php

declare(strict_types=1);

namespace Test\Provider;

final class NativeTypeProviderData
{
    public static function validTypeData(): \Generator
    {
        yield [
            'value' => 1,
            'expectedType' => 'int',
        ];

        yield [
            'value' => true,
            'expectedType' => 'bool',
        ];

        yield [
            'value' => 1.2,
            'expectedType' => 'float',
        ];

        yield [
            'value' => 'str',
            'expectedType' => 'string',
        ];

        yield [
            'value' => new \stdClass(),
            'expectedType' => 'object',
        ];

        yield [
            'value' => [],
            'expectedType' => 'array',
        ];

        yield [
            'value' => static fn() => null,
            'expectedType' => 'callable',
        ];

        yield [
            'value' => 1.1,
            'expectedType' => 'double',
        ];

        yield [
            'value' => true,
            'expectedType' => 'scalar',
        ];

        yield [
            'value' => fopen('php://memory', 'r'),
            'expectedType' => 'resource',
        ];
    }

    public static function invalidTypeData(): \Generator
    {
        yield [
            'value' => 1,
            'expectedType' => 'float',
        ];

        yield [
            'value' => true,
            'expectedType' => 'numeric',
        ];

        yield [
            'value' => 1.2,
            'expectedType' => 'string',
        ];

        yield [
            'value' => 'str',
            'expectedType' => 'bool',
        ];

        yield [
            'value' => new \stdClass(),
            'expectedType' => 'resource',
        ];

        yield [
            'value' => [],
            'expectedType' => 'bool',
        ];

        yield [
            'value' => static fn() => null,
            'expectedType' => 'int',
        ];

        yield [
            'value' => 1.1,
            'expectedType' => 'int',
        ];

        yield [
            'value' => true,
            'expectedType' => 'object',
        ];

        yield [
            'value' => fopen('php://memory', 'r'),
            'expectedType' => 'array',
        ];

        yield [
            'value' => null,
            'expectedType' => 'resource',
        ];
    }

    public static function validTypeExistsData(): \Generator
    {
        yield [
            'type' => 'string',
        ];

        yield [
            'type' => 'int',
        ];

        yield [
            'type' => 'float',
        ];

        yield [
            'type' => 'bool',
        ];

        yield [
            'type' => 'array',
        ];

        yield [
            'type' => 'object',
        ];

        yield [
            'type' => 'resource',
        ];

        yield [
            'type' => 'callable',
        ];

        yield [
            'type' => 'scalar',
        ];

        yield [
            'type' => 'numeric',
        ];

        yield [
            'type' => 'double',
        ];
    }
}

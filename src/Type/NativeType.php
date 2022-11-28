<?php

declare(strict_types=1);

namespace Collection\Type;

final class NativeType
{
    public const ARRAY = 'array';
    public const BOOL = 'bool';
    public const CALLABLE = 'callable';
    public const FLOAT = 'float';
    public const DOUBLE = 'double';
    public const INT = 'int';
    public const NUMERIC = 'numeric';
    public const OBJECT = 'object';
    public const RESOURCE = 'resource';
    public const SCALAR = 'scalar';
    public const STRING = 'string';

    private const TYPES = [
        self::ARRAY,
        self::BOOL,
        self::CALLABLE,
        self::FLOAT,
        self::DOUBLE,
        self::INT,
        self::NUMERIC,
        self::OBJECT,
        self::RESOURCE,
        self::SCALAR,
        self::STRING,
    ];

    public static function exists(string $type): bool
    {
        return in_array(strtolower($type), self::TYPES, true);
    }

    public static function notExists(string $type): bool
    {
        return !self::exists($type);
    }

    public static function isValid(mixed $item, string $type): bool
    {
        return match ($type) {
            self::ARRAY => is_array($item),
            self::BOOL => is_bool($item),
            self::CALLABLE => is_callable($item),
            self::FLOAT, self::DOUBLE => is_float($item),
            self::INT => is_int($item),
            self::NUMERIC => is_numeric($item),
            self::STRING => is_string($item),
            self::OBJECT => is_object($item),
            self::RESOURCE => is_resource($item),
            self::SCALAR => is_scalar($item),
            default => false,
        };
    }
}

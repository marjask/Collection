<?php

declare(strict_types=1);

namespace Test;

use Collection\Type\NativeType;
use PHPUnit\Framework\TestCase;

final class NativeTypeTest extends TestCase
{
    /**
     * @dataProvider \Test\Provider\NativeTypeProviderData::validTypeData
     */
    public function testValidType(mixed $value, string $type): void
    {
        $this->assertTrue(
            NativeType::isValid($value, $type)
        );
    }

    /**
     * @dataProvider \Test\Provider\NativeTypeProviderData::invalidTypeData
     */
    public function testInvalidType(mixed $value, string $type): void
    {
        $this->assertFalse(
            NativeType::isValid($value, $type)
        );
    }

    /**
     * @dataProvider \Test\Provider\NativeTypeProviderData::validTypeExistsData
     */
    public function testExistsType(string $type): void
    {
        $this->assertTrue(
            NativeType::exists($type)
        );
    }

    public function testNotExistsType(): void
    {
        $type = 'not_exists_type';

        $this->assertFalse(NativeType::exists($type));
        $this->assertTrue(NativeType::notExists($type));
    }
}

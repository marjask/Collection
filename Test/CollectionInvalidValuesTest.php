<?php

declare(strict_types=1);

namespace Test;

use Collection\AbstractCollection;
use Collection\Exception\InvalidCollectionItemTypeException;
use PHPUnit\Framework\TestCase;

final class CollectionInvalidValuesTest extends TestCase
{
    /**
     * @dataProvider \Test\Provider\CollectionInvalidValuesProviderData::invalidData
     */
    public function testAddMethodInvalidData(string $class, mixed $data): void
    {
        $this->expectException(InvalidCollectionItemTypeException::class);
        /** @var AbstractCollection $collection */
        $collection = new $class();
        $collection->add($data);
    }

    /**
     * @dataProvider \Test\Provider\CollectionInvalidValuesProviderData::invalidData
     */
    public function testStaticMethodCreateFromArrayInvalidData(string $class, mixed $data): void
    {
        $this->expectException(InvalidCollectionItemTypeException::class);
        $class::createFromArray([$data]);
    }

    /**
     * @dataProvider \Test\Provider\CollectionInvalidValuesProviderData::invalidData
     */
    public function testStaticMethodCreateFromAssocArrayInvalidData(string $class, mixed $data): void
    {
        $this->expectException(InvalidCollectionItemTypeException::class);
        $class::createFromAssocArray(['key' => $data]);
    }
}

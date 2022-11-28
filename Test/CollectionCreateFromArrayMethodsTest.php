<?php

declare(strict_types=1);

namespace Test;

use Collection\AbstractCollection;
use PHPUnit\Framework\TestCase;

final class CollectionCreateFromArrayMethodsTest extends TestCase
{
    /**
     * @dataProvider \Test\Provider\CollectionCreateFromArrayMethodsProviderData::staticCreateFromArrayData
     * @param array<mixed> $data
     * @param class-string $expectedClass
     */
    public function testStaticCreateFromArray(
        array      $data,
        mixed      $expectedFirstElement,
        mixed      $expectedLastElement,
        string|int $nameKeySecondElement,
        mixed      $expectedSecondElement,
        string|int $unassignedKeyElement,
        mixed      $unassignedElement,
        string     $expectedClass,
        int        $expectedElementsCount
    ): void {
        /** @var AbstractCollection $collection */
        $collection = $expectedClass::createFromArray($data);

        $this->runTestCollection(
            $collection,
            $expectedFirstElement,
            $expectedLastElement,
            $nameKeySecondElement,
            $expectedSecondElement,
            $unassignedKeyElement,
            $unassignedElement,
            $expectedClass,
            $expectedElementsCount
        );
    }

    /**
     * @dataProvider \Test\Provider\CollectionCreateFromArrayMethodsProviderData::staticCreateFromStaticArrayData
     * @param array<mixed> $data
     * @param class-string $expectedClass
     */
    public function testStaticCreateFromAssocArray(
        array      $data,
        mixed      $expectedFirstElement,
        mixed      $expectedLastElement,
        string|int $nameKeySecondElement,
        mixed      $expectedSecondElement,
        string|int $unassignedKeyElement,
        mixed      $unassignedElement,
        string     $expectedClass,
        int        $expectedElementsCount
    ): void {
        /** @var AbstractCollection $collection */
        $collection = $expectedClass::createFromAssocArray($data);

        $this->runTestCollection(
            $collection,
            $expectedFirstElement,
            $expectedLastElement,
            $nameKeySecondElement,
            $expectedSecondElement,
            $unassignedKeyElement,
            $unassignedElement,
            $expectedClass,
            $expectedElementsCount
        );
    }

    /**
     * @param class-string $expectedClass
     */
    private function runTestCollection(
        AbstractCollection $collection,
        mixed $expectedFirstElement,
        mixed $expectedLastElement,
        string|int $nameKeySecondElement,
        mixed $expectedSecondElement,
        string|int $unassignedKeyElement,
        mixed $unassignedElement,
        string $expectedClass,
        int $expectedElementsCount
    ): void {
        $this->assertInstanceOf($expectedClass, $collection);

        $this->assertSame($expectedFirstElement, $collection->first());
        $this->assertSame($expectedLastElement, $collection->last());

        $this->assertTrue($collection->hasElement($expectedFirstElement));
        $this->assertFalse($collection->hasNotElement($expectedFirstElement));

        $this->assertFalse($collection->hasElement($unassignedElement));
        $this->assertTrue($collection->hasNotElement($unassignedElement));

        $this->assertTrue($collection->hasKey($nameKeySecondElement));
        $this->assertFalse($collection->hasKey($unassignedKeyElement));

        $this->assertSame($expectedSecondElement, $collection->getByKey($nameKeySecondElement));

        $this->assertCount($expectedElementsCount, $collection);
        $this->assertSame($expectedElementsCount, $collection->count());

        $this->assertInstanceOf(\ArrayIterator::class, $collection->getIterator());

        $this->assertFalse($collection->isEmpty());
        $this->assertTrue($collection->isNotEmpty());

        $collection->clear();

        $this->assertTrue($collection->isEmpty());
        $this->assertFalse($collection->isNotEmpty());
    }
}

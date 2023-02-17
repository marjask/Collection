<?php

declare(strict_types=1);

namespace Test;

use Collection\AbstractCollection;
use Collection\Exception\NotFoundIndicatedKeyException;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    /**
     * @dataProvider \Test\Provider\CollectionMethodFilterProviderData::data
     */
    public function testMethodFilter(
        AbstractCollection $collection,
        int $expectedCount,
        callable $filter,
    ): void {
        $this->assertCount(
            $expectedCount,
            $collection->filter($filter)
        );
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodReduceProviderData::data
     */
    public function testMethodReduce(
        AbstractCollection $collection,
        mixed $expected,
        callable $filter,
    ): void {
        $this->assertSame(
            $expected,
            $collection->reduce($filter)
        );
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodMapProviderData::data
     */
    public function testMethodMap(
        AbstractCollection $collection,
        mixed $expected,
        callable $filter,
    ): void {
        $this->assertSame(
            $expected,
            $collection->map($filter)
        );
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodMergeProviderData::data
     */
    public function testMethodMerge(
        AbstractCollection $collection,
        AbstractCollection $collectionToMerge,
        mixed $element,
        mixed $elementToMerge,
    ): void {
        $collection->add($element);
        $collectionToMerge->add($elementToMerge);

        $this->assertCount(1, $collection);

        $collection->merge($collectionToMerge);

        $this->assertCount(2, $collection);
        $this->assertSame($elementToMerge, $collection->last());
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodMergeProviderData::dataWithOverwrite
     */
    public function testMethodMergeWithOverwrite(
        AbstractCollection $collection,
        AbstractCollection $collectionToMerge,
        string $key,
        mixed $element,
        mixed $elementToMerge,
    ): void {
        $collection->add($element, $key);
        $collectionToMerge->add($elementToMerge, $key);

        $this->assertCount(1, $collection);

        $collection->merge($collectionToMerge, true);

        $this->assertCount(1, $collection);
        $this->assertSame($elementToMerge, $collection->first());
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodRemoveProviderData::data
     */
    public function testRemoveElement(
        AbstractCollection $collection,
        mixed $element,
        mixed $elementUnassigned,
    ): void {
        $collection->add($element);

        $this->assertFalse($collection->remove($elementUnassigned));
        $this->assertTrue($collection->remove($element));
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodHasAndHasNotElementProviderData::data
     */
    public function testHasAndHasNotElement(
        AbstractCollection $collection,
        mixed $element,
        mixed $elementUnassigned,
    ): void {
        $collection->add($element);

        $this->assertFalse($collection->hasElement($elementUnassigned));
        $this->assertTrue($collection->hasElement($element));
        $this->assertFalse($collection->hasNotElement($element));
        $this->assertTrue($collection->hasNotElement($elementUnassigned));
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodRemoveByKeyProviderData::data
     */
    public function testRemoveByKey(
        AbstractCollection $collection,
        mixed $element,
        string $key,
        string $keyUnassigned,
    ): void {
        $collection->add($element, $key);

        $this->assertFalse($collection->removeByKey($keyUnassigned));
        $this->assertTrue($collection->removeByKey($key));
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodColumnProviderData::dataForException
     */
    public function testColumnException(
        AbstractCollection $collection,
        int|string $column,
    ): void {
        $this->expectException(NotFoundIndicatedKeyException::class);
        $collection->column($column);
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodColumnProviderData::validData()
     * @param array<mixed> $expected
     */
    public function testValidColumn(
        AbstractCollection $collection,
        int|string $column,
        array $expected,
    ): void {
        $this->assertSame($expected, $collection->column($column));
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodPullFirstProviderData::data
     */
    public function testPullFirstElement(
        AbstractCollection $collection,
        mixed $element,
        mixed $element2,
    ): void {
        $collection
            ->add($element)
            ->add($element2);

        $this->assertCount(2, $collection);
        $this->assertSame($element, $collection->pullFirst());
        $this->assertCount(1, $collection);
        $this->assertSame($element2, $collection->pullFirst());
        $this->assertCount(0, $collection);
        $this->assertNull($collection->pullFirst());
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodPullLastProviderData::data
     */
    public function testPullLastElement(
        AbstractCollection $collection,
        mixed $element,
        mixed $element2,
    ): void {
        $collection
            ->add($element)
            ->add($element2);

        $this->assertCount(2, $collection);
        $this->assertSame($element2, $collection->pullLast());
        $this->assertCount(1, $collection);
        $this->assertSame($element, $collection->pullLast());
        $this->assertCount(0, $collection);
        $this->assertNull($collection->pullLast());
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodCountProviderData::data
     */
    public function testCount(
        AbstractCollection $collection,
        int $expectedCount,
    ): void {
        $this->assertCount($expectedCount, $collection);
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodIsEmptyProviderData::data
     */
    public function testIsEmpty(
        AbstractCollection $collection,
    ): void {
        $this->assertTrue($collection->isEmpty());
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodIsNotEmptyProviderData::data
     */
    public function testIsNotEmpty(
        AbstractCollection $collection,
        mixed $element,
    ): void {
        $collection->add($element);

        $this->assertTrue($collection->isNotEmpty());
    }

    /**
     * @dataProvider \Test\Provider\CollectionMethodFirstProviderData::data
     */
    public function testFirst(
        AbstractCollection $collection,
        mixed $element,
    ): void {
        $this->assertSame($element, $collection->first());
    }
}

<?php

declare(strict_types=1);

namespace Test;

use Collection\Exception\NotFoundIndicatedKeyException;
use Collection\IntCollection;
use PHPUnit\Framework\TestCase;

final class IntCollectionTest extends TestCase
{
    public function testMethodFilter(): void
    {
        $collection = new IntCollection();
        $collection->add(1);
        $collection->add(7);

        $this->assertCount(
            1,
            $collection->filter(static function (int $item): bool {
                return $item < 5;
            })
        );
    }

    public function testMethodReduce(): void
    {
        $collection = new IntCollection();
        $collection->add(1);
        $collection->add(7);
        $collection->add(5);

        $this->assertSame(
            13,
            $collection->reduce(static function (?int $curry, int $item): ?int {
                return $item + $curry;
            })
        );
    }

    public function testMethodMap(): void
    {
        $collection = new IntCollection();
        $collection->add(1);
        $collection->add(7);
        $collection->add(5);

        $this->assertSame(
            [2,14,10],
            $collection->map(static function (int $item): int {
                return $item * 2;
            })
        );
    }

    public function testMethodMerge(): void
    {
        $element = 6;
        $elementToMerge = 9;
        $collection = new IntCollection();
        $collectionToMerge = new IntCollection();
        $collection->add($element);
        $collectionToMerge->add($elementToMerge);

        $this->assertCount(1, $collection);

        $collection->merge($collectionToMerge);

        $this->assertCount(2, $collection);
        $this->assertSame($elementToMerge, $collection->last());
    }

    public function testMethodMergeWithOverwrite(): void
    {
        $key = 'key';
        $element = 6;
        $elementToMerge = 9;

        $collection = new IntCollection();
        $collectionToMerge = new IntCollection();
        $collection->add($element, $key);
        $collectionToMerge->add($elementToMerge, $key);

        $this->assertCount(1, $collection);

        $collection->merge($collectionToMerge, true);

        $this->assertCount(1, $collection);
        $this->assertSame($elementToMerge, $collection->first());
    }

    public function testRemoveElement(): void
    {
        $element = 100;
        $elementUnassigned = 10;

        $collection = (new IntCollection())
            ->add($element);

        $this->assertFalse($collection->remove($elementUnassigned));
        $this->assertTrue($collection->remove($element));
    }

    public function testHasAndHasNotElement(): void
    {
        $element = 100;
        $elementUnassigned = 10;

        $collection = (new IntCollection())
            ->add($element);

        $this->assertFalse($collection->hasElement($elementUnassigned));
        $this->assertTrue($collection->hasElement($element));
        $this->assertFalse($collection->hasNotElement($element));
        $this->assertTrue($collection->hasNotElement($elementUnassigned));
    }

    public function testRemoveByKey(): void
    {
        $collection = IntCollection::createFromAssocArray([
            'phpunit' => 10,
            'test' => 100,
        ]);

        $this->assertFalse($collection->removeByKey('test2'));
        $this->assertTrue($collection->removeByKey('test'));
    }

    public function testGetColumn(): void
    {
        $this->expectException(NotFoundIndicatedKeyException::class);
        $collection = IntCollection::createFromArray([1,2,3]);
        $collection->column('column');
    }

    public function testPullFirstElement(): void
    {
        $firstElement = 1;
        $secondElement = 2;
        $collection = IntCollection::createFromAssocArray([
            'first' => $firstElement,
            'second' => $secondElement,
        ]);

        $this->assertCount(2, $collection);
        $this->assertSame($firstElement, $collection->pullFirst());
        $this->assertCount(1, $collection);
        $this->assertSame($secondElement, $collection->pullFirst());
        $this->assertCount(0, $collection);
        $this->assertNull($collection->pullFirst());
    }

    public function testPullLastElement(): void
    {
        $firstElement = 1;
        $secondElement = 2;
        $collection = IntCollection::createFromAssocArray([
            'first' => $firstElement,
            'second' => $secondElement,
        ]);

        $this->assertCount(2, $collection);
        $this->assertSame($secondElement, $collection->pullLast());
        $this->assertCount(1, $collection);
        $this->assertSame($firstElement, $collection->pullLast());
        $this->assertCount(0, $collection);
        $this->assertNull($collection->pullLast());
    }
}

<?php

declare(strict_types=1);

namespace Test;

use Collection\ArrayCollection;
use PHPUnit\Framework\TestCase;

final class ArrayCollectionTest extends TestCase
{
    public function testMethodFilter(): void
    {
        $collection = new ArrayCollection();
        $collection->add([1,4,8]);
        $collection->add([2,7,9]);

        $this->assertCount(
            1,
            $collection->filter(static function (array $item): bool {
                return array_sum($item) > 15;
            })
        );
    }

    public function testMethodReduce(): void
    {
        $collection = new ArrayCollection();
        $collection->add([1,4,8]);
        $collection->add([2,7,9]);

        $this->assertSame(
            31,
            $collection->reduce(static function (?int $curry, array $item): int|float {
                return array_sum($item) + $curry;
            })
        );
    }

    public function testMethodMap(): void
    {
        $collection = new ArrayCollection();
        $collection->add([1,4,8]);
        $collection->add([2,7,9]);
        $collection->add([3,10,7]);

        $this->assertSame(
            [
                [2,8,16],
                [4,14,18],
                [6,20,14],
            ],
            $collection->map(static function (array $item): array {
                return array_map(
                    static function ($element): int {
                        return $element * 2;
                    },
                    $item
                );
            })
        );
    }

    public function testMethodMerge(): void
    {
        $arrayCollection = [1,4,8];
        $arrayCollectionToMerge = [2,7,9];
        $collection = new ArrayCollection();
        $collectionToMerge = new ArrayCollection();
        $collection->add($arrayCollection);
        $collectionToMerge->add($arrayCollectionToMerge);

        $this->assertCount(1, $collection);

        $collection->merge($collectionToMerge);

        $this->assertCount(2, $collection);
        $this->assertSame($arrayCollectionToMerge, $collection->last());
    }

    public function testMethodMergeWithOverwrite(): void
    {
        $key = 'key';
        $arrayCollection = [1,4,8];
        $arrayCollectionToMerge = [2,7,9];

        $collection = new ArrayCollection();
        $collectionToMerge = new ArrayCollection();
        $collection->add($arrayCollection, $key);
        $collectionToMerge->add($arrayCollectionToMerge, $key);

        $this->assertCount(1, $collection);

        $collection->merge($collectionToMerge, true);

        $this->assertCount(1, $collection);
        $this->assertSame($arrayCollectionToMerge, $collection->first());
    }

    public function testRemoveElement(): void
    {
        $element = ['phpunit' => true];
        $elementUnassigned = ['unassigned' => true];

        $collection = (new ArrayCollection())
            ->add($element);

        $this->assertFalse($collection->remove($elementUnassigned));
        $this->assertTrue($collection->remove($element));
    }

    public function testHasAndHasNotElement(): void
    {
        $element = ['phpunit' => true];
        $elementUnassigned = ['unassigned' => true];

        $collection = (new ArrayCollection())
            ->add($element);

        $this->assertFalse($collection->hasElement($elementUnassigned));
        $this->assertTrue($collection->hasElement($element));
        $this->assertFalse($collection->hasNotElement($element));
        $this->assertTrue($collection->hasNotElement($elementUnassigned));
    }

    public function testRemoveByKey(): void
    {
        $collection = ArrayCollection::createFromAssocArray([
            'phpunit' => [true],
            'test' => [true],
        ]);

        $this->assertFalse($collection->removeByKey('test2'));
        $this->assertTrue($collection->removeByKey('test'));
    }

    public function testGetColumn(): void
    {
        $collection = ArrayCollection::createFromArray([
            ['column' => 1, 'test' => true],
            ['column' => 2, 'test' => true],
            ['column' => 3, 'test' => true],
            ['column' => 4, 'test' => true],
        ]);
        $expected = [1,2,3,4];

        $this->assertSame($expected, $collection->column('column'));
    }

    public function testPullFirstElement(): void
    {
        $firstElement = [
            'element' => true,
            'test' => false,
        ];
        $secondElement = [
            'phpunit' => 2,
            'testcase' => '123123',
        ];
        $collection = ArrayCollection::createFromAssocArray([
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
        $firstElement = [
            'element' => true,
            'test' => false,
        ];
        $secondElement = [
            'phpunit' => 2,
            'testcase' => '123123',
        ];
        $collection = ArrayCollection::createFromAssocArray([
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

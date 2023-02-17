<?php

declare(strict_types=1);

namespace Test;

use Collection\Exception\InvalidCollectionItemTypeException;
use PHPUnit\Framework\TestCase;
use Test\Stub\Stub;
use Test\Stub\StubCollection;

final class StubCollectionTest extends TestCase
{
    public function testAddElement(): void
    {
        $collection = new StubCollection();

        $this->assertTrue($collection->isEmpty());

        $obj = new Stub();
        $collection->add($obj);

        $this->assertTrue($collection->isNotEmpty());
        $this->assertSame($obj, $collection->first());
    }

    public function testInvalidAddElement(): void
    {
        $collection = new StubCollection();

        $this->expectException(InvalidCollectionItemTypeException::class);
        $collection->add(new \DateTime());
    }

    public function testAddElementWithKey(): void
    {
        $collection = new StubCollection();

        $this->assertTrue($collection->isEmpty());

        $obj = new Stub();
        $collection->add($obj, 'key');

        $this->assertTrue($collection->isNotEmpty());
        $this->assertSame($obj, $collection->first());
        $this->assertSame($obj, $collection->getByKey('key'));
        $this->assertTrue($collection->hasKey('key'));
        $this->assertTrue($collection->hasElement($obj));
        $this->assertFalse($collection->hasElement(new Stub()));
        $this->assertFalse($collection->remove(new Stub()));
        $this->assertTrue($collection->remove($obj));
    }
}

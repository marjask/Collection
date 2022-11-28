<?php

declare(strict_types=1);

namespace Test;

use Closure;
use Collection\AbstractCollection;
use PHPUnit\Framework\TestCase;

final class MethodFilterTest extends TestCase
{
    /**
     * @dataProvider \Test\Provider\MethodFilterProviderData::data
     * @param array<mixed> $elements
     */
    public function testMethodFilter(
        string $class,
        array $elements,
        int $expectedCount,
        Closure $fn
    ): void {
        /** @var AbstractCollection $collection */
        $collection = $class::createFromArray($elements);

        $this->assertCount(
            $expectedCount,
            $collection->filter($fn)
        );
    }
}

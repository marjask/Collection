<?php

declare(strict_types=1);

namespace Test\Stub;

use Collection\AbstractCollection;

final class StubCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return Stub::class;
    }
}

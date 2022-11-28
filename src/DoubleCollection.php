<?php

declare(strict_types=1);

namespace Collection;

use Collection\Type\NativeType;

class DoubleCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return NativeType::DOUBLE;
    }
}

<?php

declare(strict_types=1);

namespace Collection;

use Collection\Type\NativeType;

class ObjectCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return NativeType::OBJECT;
    }
}

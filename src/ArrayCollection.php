<?php

declare(strict_types=1);

namespace Collection;

use Collection\Type\NativeType;

class ArrayCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return NativeType::ARRAY;
    }
}

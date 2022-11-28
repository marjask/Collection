<?php

declare(strict_types=1);

namespace Collection;

use Collection\Type\NativeType;

class ScalarCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return NativeType::SCALAR;
    }
}

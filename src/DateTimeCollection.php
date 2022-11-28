<?php

declare(strict_types=1);

namespace Collection;

class DateTimeCollection extends AbstractCollection
{
    protected function getCollectionType(): string
    {
        return \DateTime::class;
    }
}

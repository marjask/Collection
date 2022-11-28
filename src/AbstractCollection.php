<?php

declare(strict_types=1);

namespace Collection;

use Closure;
use Collection\Exception\InvalidCollectionItemTypeException;
use Collection\Exception\InvalidCollectionTypeException;
use Collection\Exception\NotFoundIndicatedKeyException;
use Collection\Type\NativeType;
use Traversable;

abstract class AbstractCollection implements \IteratorAggregate, \Countable
{
    protected array $collection = [];
    private string $collectionType;

    abstract protected function getCollectionType(): string;

    final public function __construct()
    {
        $this->collectionType = $this->getCollectionType();

        $this->throwIfInvalidCollectionType();
    }

    public static function createFromArray(array $array): static
    {
        $collection = new static();

        foreach ($array as $value) {
            $collection->add($value);
        }

        return $collection;
    }

    public static function createFromAssocArray(array $array): static
    {
        $collection = new static();

        foreach ($array as $key => $value) {
            $collection->add($value, $key);
        }

        return $collection;
    }

    private function throwIfInvalidCollectionType(): void
    {
        if (
            NativeType::notExists($this->collectionType)
            && !class_exists($this->collectionType)
            && !interface_exists($this->collectionType)
        ) {
            throw new InvalidCollectionTypeException(
                sprintf('Invalid collectionType %s.', $this->collectionType)
            );
        }
    }

    protected function throwIfInvalidItemType(mixed $item): bool
    {
        if (NativeType::exists($this->collectionType) && NativeType::isValid($item, $this->collectionType)) {
            return true;
        }

        if ($item instanceof $this->collectionType) {
            return true;
        }

        throw new InvalidCollectionItemTypeException(
            sprintf('Invalid item type, received %s, expected %s', gettype($item), $this->collectionType)
        );
    }

    final public function add(mixed $item, string|int|null $key = null): static
    {
        $this->throwIfInvalidItemType($item);

        if (is_null($key)) {
            $this->collection[] = $item;
        } else {
            $this->collection[$key] = $item;
        }

        return $this;
    }

    final protected function getCollection(): array
    {
        return $this->collection;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->getCollection());
    }

    public function count(): int
    {
        return count($this->getCollection());
    }

    public function isEmpty(): bool
    {
        return empty($this->getCollection());
    }

    final public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    final public function hasElement(mixed $item, bool $strict = true): bool
    {
        return in_array($item, $this->collection, $strict);
    }

    final public function hasNotElement($collectionItem): bool
    {
        return !$this->hasElement($collectionItem);
    }

    final public function first()
    {
        return reset($this->collection) ?: null;
    }

    final protected function sort(Closure $closure): self
    {
        usort($this->collection, $closure);

        return $this;
    }

    final public function filter(Closure $closure): self
    {
        $this->collection = array_filter($this->collection, $closure);

        return $this;
    }

    final public function last()
    {
        return !empty($this->collection)
            ? end($this->collection)
            : null;
    }

    final public function pullFirst()
    {
        return array_shift($this->collection);
    }

    final public function pullLast()
    {
        return array_pop($this->collection);
    }

    public function map(Closure $p): array
    {
        return array_map($p, $this->getCollection());
    }

    final public function getByKey(string|int $key)
    {
        return $this->hasKey($key) ? $this->collection[$key] : null;
    }

    final public function hasKey(string|int $key): bool
    {
        return array_key_exists($key, $this->collection);
    }

    final public function removeByKey(string|int $key): bool
    {
        if (array_key_exists($key, $this->collection)) {
            unset($this->collection[$key]);
            return true;
        }

        return false;
    }

    public function remove(mixed $item): bool
    {
        $this->throwIfInvalidItemType($item);

        $key = array_search($item, $this->collection, true);

        if ($key !== false) {
            unset($this->collection[$key]);

            return true;
        }

        return false;
    }

    public function column(string $keyOrPropertyOrMethod): array
    {
        $values = [];

        foreach ($this->getCollection() as $item) {
            if (is_array($item) && array_key_exists($keyOrPropertyOrMethod, $item)) {
                $values[] = $item[$keyOrPropertyOrMethod];
                continue;
            }

            if (is_object($item)) {
                if (property_exists($item, $keyOrPropertyOrMethod)) {
                    $values[] = $item->$keyOrPropertyOrMethod;
                    continue;
                }

                if (method_exists($item, $keyOrPropertyOrMethod)) {
                    $values[] = $item->$keyOrPropertyOrMethod();
                    continue;
                }
            }

            throw new NotFoundIndicatedKeyException('The indicated key was not found.');
        }

        return $values;
    }

    public function merge(self $otherCollection, bool $overwriteKeys = false): static
    {
        foreach ($otherCollection as $key => $item) {
            $this->add(
                $item,
                $overwriteKeys === true ? $key : null
            );
        }

        return $this;
    }

    final public function reduce(callable $callback, $initial = null): mixed
    {
        return array_reduce($this->getCollection(), $callback, $initial);
    }

    final public function clear(): static
    {
        $this->collection = [];

        return $this;
    }
}

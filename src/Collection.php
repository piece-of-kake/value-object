<?php

namespace PoK\ValueObject;

class Collection implements \ArrayAccess, \Countable, \IteratorAggregate
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function first()
    {
        $arrayValues = array_values($this->items);
        return (array_key_exists(0, $arrayValues))
            ? $arrayValues[0]
            : null;
    }

    protected function newStatic(array $items): self
    {
        return new static($items);
    }

    public function each(callable $callback): void
    {
        foreach ($this->items as $key => $item) {
            $callback($item, $key);
        }
    }

    public function map(callable $callback): self
    {
        $items = $this->items;
        foreach ($items as $key => &$value) {
            $value = $callback($value, $key);
        }
        return $this->newStatic($items);
    }

    public function filter(callable $callback): Collection
    {
        return $this->newStatic(array_filter($this->items, $callback));
    }

    /**
     * @param callable $callback
     * @return Collection
     */
    public function sort(callable $callback): Collection
    {
        $sortedArray = $this->items;
        usort($sortedArray, $callback);
        return $this->newStatic($sortedArray);
    }

    /**
     * Finds the first matching item through callback or returns null.
     *
     * @param callable $callback
     * @return mixed|null
     */
    public function find(callable $callback)
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key)) return $item;
        }

        return null;
    }

    /**
     * Picks out one random item from the collection
     * @return mixed
     */
    public function random()
    {
        return $this->items[array_rand($this->items)];
    }

    public function reduce(callable $callback, $initial)
    {
        $accumulator = $initial;

        foreach ($this->items as $key => $item) {
            $accumulator = $callback($accumulator, $item, $key);
        }

        return $accumulator;
    }

    public function switchKey($oldKey, $newKey)
    {
        if ($oldKey === $newKey) return $this;

        $newArray = $this->items;
        if (array_key_exists($oldKey, $newArray)) {
            $newArray[$newKey] = $newArray[$oldKey];
            unset($newArray[$oldKey]);
        }

        return $this->newStatic($newArray);
    }

    /**
     * Starts at the beginning of the collection and replaces keys until all new keys are used or the end of the
     * collection is reached.
     *
     * @param array $keys
     */
    public function replaceKeys(array $keys)
    {
        $keys = array_values($keys);

        $newArray = [];

        $increment = 0;
        foreach ($this->items as $key => $value) {
            if (array_key_exists($increment, $keys)) {
                $newArray[$keys[$increment++]] = $value;
            } else {
                $newArray[$key] = $value;
            }
        }

        return $this->newStatic($newArray);
    }

    public function skipFirst()
    {
        return $this->newStatic(array_slice($this->items, 1));
    }

    public function skip(callable $callaback)
    {
        $items = $this->items;

        foreach ($items as $key => $value) {
            if ($callaback($value)) {
                unset($items[$key]);
            }
        }

        return $this->newStatic($items);
    }

    public function slice(int $offset, int $length = 1)
    {
        return $this->newStatic(array_slice($this->items, $offset, $length));
    }

    public function extract($index)
    {
        return $this->newStatic($this->items[$index]);
    }

    public function merge($collection): self
    {
        if ($collection instanceof Collection) {
            return $this->newStatic(array_merge($this->items, $collection->toArray()));
        } elseif (is_array($collection)) {
            return $this->newStatic(array_merge($this->items, $collection));
        }
        // ToDo: Let's throw an exception here (Sasa|05/2021)
    }

    public function unique(): self
    {
        return $this->newStatic(array_values(array_unique($this->items)));
    }

    public function implode(string $glue): string
    {
        return implode($glue, $this->items);
    }

    /**
     * IMPORTANT!!
     * If you need only values (F.E. indexed array) ALWAYS use arrayValues().
     * The reason is that if you perform skip on a indexed array Collection it will become associative and you can have an isse.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * Get underlying array values.
     * Use this if you need only array values, especially if you performed skip() on an indexed array Collection!
     *
     * @return array
     */
    public function arrayValues(): array
    {
        return array_values($this->items);
    }

    public function arrayKeys(): array
    {
        return array_keys($this->items);
    }

    /**
     * Alias of offsetExists, because PHP array_key_exists() doesn't work properly.
     *
     * @param string|int $key
     * @return bool
     */
    public function has($key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * Because PHP empty() doesn't work with ArrayAccess as one would hope.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * PHP array_key_exists() should use this function but it doesn't. Call this directly or use $this->has().
     *
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }
}

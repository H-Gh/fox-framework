<?php

namespace Fox\Collection;

use Iterator;

/**
 * A concept to hold data as array
 * PHP version >= 7.0
 *
 * @category Collection
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class Collection implements Iterator, CollectionInterface
{
    /**
     * The array to hold the data
     *
     * @var array
     */
    protected $collection = [];

    /**
     * Put new data into array
     *
     * @param mixed $data  The data
     * @param int   $index The index of array
     *
     * @return CollectionInterface
     */
    public function add($data, $index = null): CollectionInterface
    {
        if (!is_null($index)) {
            $this->collection[$index] = $data;
        } else {
            $this->collection[] = $data;
        }
        return $this;
    }

    /**
     * Get the data from array
     *
     * @param mixed $index The index of array
     *
     * @return mixed
     */
    public function get($index)
    {
        if (isset($this->collection[$index])) {
            return $this->collection[$index];
        }
        return null;
    }

    /**
     * Update and existence index of array
     *
     * @param int   $index The index of array
     * @param mixed $data  The data
     *
     * @return CollectionInterface
     */
    public function update(int $index, $data): CollectionInterface
    {
        $this->collection[$index] = $data;
        return $this;
    }

    /**
     * Check what if the collection has member or not
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->collection);
    }

    /**
     * Return count of memebers
     *
     * @return bool
     */
    public function count(): int
    {
        return count($this->collection);
    }

    /**
     * Get the current element of array
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->collection);
    }


    /**
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
        return next($this->collection);
    }

    /**
     * Return the key of the current element
     *
     * @return string|float|int|bool|null
     */
    public function key()
    {
        return key($this->collection);
    }

    /**
     * Checks if current position is valid
     *
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        $key = key($this->collection);
        return ($key !== null && $key !== false);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
        reset($this->collection);
    }

    /**
     * @param string $key
     *
     * @return CollectionInterface
     */
    public function groupBy(string $key): CollectionInterface
    {
        $items = new self();
        foreach ($this->collection as $index => $item) {
            $itemArray = $this->getAsArray($item);
            if (isset($itemArray[$key])) {
                $keyCollection = $items->get($itemArray[$key]);
                if (!$keyCollection instanceof self) {
                    $keyCollection = new self();
                }
                $keyCollection->add($item);
                $items->add($keyCollection, $itemArray[$key]);
            }
        }
        return $items;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->collection;
    }

    /**
     * @param mixed $item
     *
     * @return array
     */
    private function getAsArray($item): array
    {
        if (is_array($item)) {
            return $item;
        }
        if ($item instanceof Collection) {
            return $item->toArray();
        }
        if (method_exists($item, "toArray")) {
            return $item->toArray();
        }
        return [];
    }

    /**
     * @param CollectionInterface|array $collection
     *
     * @return $this
     */
    public function merge(CollectionInterface|array $collection): CollectionInterface
    {
        $newArray = $collection instanceof self ? $collection->toArray() : $collection;
        $this->collection = array_merge($this->collection, $newArray);
        return $this;
    }

    /**
     * @param string $key
     *
     * @return Collection
     */
    public function pluck(string $key): CollectionInterface
    {
        $items = new self();
        foreach ($this->collection as $index => $item) {
            $itemArray = $this->getAsArray($item);
            if (isset($itemArray[$key])) {
                $items->add($itemArray[$key]);
            }
        }
        return $items;
    }

    /**
     * @param string $key
     *
     * @return float|int
     */
    public function sum(string $key): float|int
    {
        return array_sum($this->pluck($key)->toArray());
    }
}

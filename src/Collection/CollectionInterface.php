<?php

namespace Fox\Collection;

/**
 * Interface to Collection concept
 * PHP version >= 7.0
 *
 * @category Collection
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
interface CollectionInterface
{
    /**
     * Put new data into array
     *
     * @param mixed $data  The data
     * @param null  $index The index of array
     *
     * @return CollectionInterface
     */
    public function add($data, $index = null): CollectionInterface;

    /**
     * Get the data from array
     *
     * @param int $index The index of array
     *
     * @return mixed
     */
    public function get(int $index);

    /**
     * Update and existence index of array
     *
     * @param int   $index The index of array
     * @param mixed $data  The data
     *
     * @return CollectionInterface
     */
    public function update(int $index, $data): CollectionInterface;

    /**
     * Check what if the collection has member or not
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Return count of members
     *
     * @return int
     */
    public function count(): int;

    /**
     * @param string $key
     *
     * @return CollectionInterface
     */
    public function groupBy(string $key): CollectionInterface;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @param CollectionInterface|array $collection
     *
     * @return $this
     */
    public function merge(CollectionInterface|array $collection): CollectionInterface;


    /**
     * @param string $key
     *
     * @return Collection
     */
    public function pluck(string $key): CollectionInterface;


    /**
     * @param string $key
     *
     * @return float|int
     */
    public function sum(string $key);
}

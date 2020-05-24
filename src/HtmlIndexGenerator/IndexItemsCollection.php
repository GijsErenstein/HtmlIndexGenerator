<?php

namespace HtmlIndexGenerator;

use Countable;
use iterable;

class IndexItemsCollection implements iterable, countable
{
    /**
     * @var IndexItem[]|array
     */
    private $elements = [];

    /**
     * @return array|IndexItem[]
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * @return IndexItem|mixed
     */
    public function first()
    {
        return reset($this->elements);
    }

    /**
     * @return IndexItem|mixed
     */
    public function last()
    {
        return end($this->elements);
    }

    /**
     * @return int|string|null
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * @return IndexItem|mixed
     */
    public function next()
    {
        return next($this->elements);
    }

    /**
     * @return IndexItem|mixed
     */
    public function current()
    {
        return current($this->elements);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * @param IndexItem $indexItem
     */
    public function add(IndexItem $indexItem)
    {
        $this->elements[] = $indexItem;
    }
}
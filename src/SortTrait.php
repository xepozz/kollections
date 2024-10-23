<?php

declare(strict_types=1);

namespace Xepozz\Kollections;

/**
 * @property-write array $values
 */
trait SortTrait
{
    public function sort(callable $callback): self
    {
        \usort($this->values, $callback);
        return $this;
    }

    public function sortKeys(callable $callback): self
    {
        \uksort($this->values, $callback);
        return $this;
    }

    public function sortByKeys(): self
    {
        \ksort($this->values);
        return $this;
    }

    public function sortByValues(): self
    {
        \asort($this->values);
        return $this;
    }

    public function sortAsNumeric(): self
    {
        \asort($this->values, SORT_NUMERIC);
        return $this;
    }

    public function sortAsNatural(): self
    {
        \asort($this->values, SORT_NATURAL);
        return $this;
    }

    public function sortAsNaturalCaseInsensitively(): self
    {
        \asort($this->values, SORT_FLAG_CASE | SORT_NATURAL);
        return $this;
    }

    public function sortAsString(): self
    {
        \asort($this->values, SORT_STRING);
        return $this;
    }

    public function sortAsStringCaseInsensitively(): self
    {
        \asort($this->values, SORT_FLAG_CASE | SORT_STRING);
        return $this;
    }

    public function reverse(): self
    {
        $this->values = \array_reverse($this->values, true);
        return $this;
    }

    public function shuffle(): self
    {
        \shuffle($this->values);
        return $this;
    }
}
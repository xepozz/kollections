<?php

declare(strict_types=1);

namespace Xepozz\Kollections;

/**
 * @property-write array $values
 */
trait MapTrait
{
    public function map(callable $callback): self
    {
        $this->values = \array_map($callback, $this->values);
        return $this;
    }

    public function mapNotNull(callable $callback): self
    {
        $this->values = \array_filter(array_map($callback, $this->values), static fn ($value) => $value !== null);
        return $this;
    }

    public function mapKeys(callable $callback): self
    {
        $this->values = \array_combine(\array_map($callback, array_keys($this->values)), $this->values);
        return $this;
    }

    public function mapIndexed(callable $callback): self
    {
        $this->values = \array_map($callback, $this->values, array_keys($this->values));
        return $this;
    }

    public function flatMap(callable $callback): self
    {
        $this->map($callback);
        $this->values = \array_merge(...$this->values);
        return $this;
    }

    public function flatMapIndexed(callable $callback): self
    {
        $this->mapIndexed($callback);
        $this->values = \array_merge(...$this->values);
        return $this;
    }
}
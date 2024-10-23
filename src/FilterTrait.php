<?php

declare(strict_types=1);

namespace Xepozz\Kollections;

/**
 * @property-write array $values
 */
trait FilterTrait
{
    public function filter(callable $filter): self
    {
        $this->values = \array_filter($this->values, $filter, \ARRAY_FILTER_USE_BOTH);
        return $this;
    }

    public function filterKeys(callable $filter): self
    {
        $this->values = \array_filter($this->values, $filter, \ARRAY_FILTER_USE_KEY);
        return $this;
    }

    public function filterNot(callable $filter): self
    {
        $this->values = \array_filter(
            $this->values,
            static fn (...$args) => !$filter(...$args),
            \ARRAY_FILTER_USE_BOTH
        );
        return $this;
    }

    public function filterNotNull(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => $value !== null);
        return $this;
    }

    public function filterNull(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => $value === null);
        return $this;
    }

    public function filterStrings(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_string($value));
        return $this;
    }

    public function filterIntegers(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_int($value));
        return $this;
    }

    public function filterFloats(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_float($value));
        return $this;
    }

    public function filterBooleans(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_bool($value));
        return $this;
    }

    public function filterArrays(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_array($value));
        return $this;
    }

    public function filterObjects(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_object($value));
        return $this;
    }

    public function filterScalars(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_scalar($value));
        return $this;
    }

    public function filterCallables(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_callable($value));
        return $this;
    }

    public function filterIterables(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_iterable($value));
        return $this;
    }

    public function filterResources(): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => \is_resource($value));
        return $this;
    }

    public function filterInstanceOf(string $className): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => $value instanceof $className);
        return $this;
    }

    public function filterNotInstanceOf(string $className): self
    {
        $this->values = \array_filter($this->values, static fn ($value) => !($value instanceof $className));
        return $this;
    }

}
<?php

declare(strict_types=1);

namespace Xepozz\Kollections;

/**
 * @property-write array $values
 */
trait FindTrait
{
    public function findFirst(callable $callback)
    {
        foreach ($this->values as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }

        return null;
    }

    public function findLast(callable $callback)
    {
        $reversed = \array_reverse($this->values, true);
        foreach ($reversed as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }

        return null;
    }

    public function findFirstKey(callable $callback)
    {
        foreach ($this->values as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }

        return null;
    }

    public function findLastKey(callable $callback)
    {
        $reversed = \array_reverse($this->values, true);
        foreach ($reversed as $key => $value) {
            if ($callback($value, $key)) {
                return $key;
            }
        }

        return null;
    }

}
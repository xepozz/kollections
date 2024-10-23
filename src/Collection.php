<?php

declare(strict_types=1);

namespace Xepozz\Kollections;

class Collection
{
    use SortTrait;
    use FindTrait;
    use MapTrait;
    use FilterTrait;

    public function __construct(
        private array $values
    ) {
    }

    public static function of(...$values): self
    {
        return new static($values);
    }

    public static function from(array $values): self
    {
        return new static($values);
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function toArray(): array
    {
        return array_values($this->values);
    }
}
<?php

declare(strict_types=1);

namespace Xepozz\Kollections\Tests;

use PHPUnit\Framework\TestCase;
use Xepozz\Kollections\Collection;

class MapTest extends TestCase
{
    public function testMap()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $collection->map(static fn ($value) => $value * 2);
        $this->assertSame([2, 4, 6, 8, 10], $collection->getValues());
    }

    public function testMapNotNull()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $collection->mapNotNull(static fn ($value) => $value % 2 === 0 ? null : $value);
        $this->assertSame([0 => 1, 2 => 3, 4 => 5], $collection->getValues());
    }

    public function testMapKeys()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $collection->mapKeys(static fn ($key) => $key * 2);
        $this->assertSame([0 => 1, 2 => 2, 4 => 3, 6 => 4, 8 => 5], $collection->getValues());
    }

    public function testMapIndexed()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $collection->mapIndexed(static fn ($value, $index) => $value * $index);
        $this->assertSame([0, 2, 6, 12, 20], $collection->getValues());
    }

    public function testFlatMap()
    {
        $collection = Collection::of([1, 2], [3, 4], [5, 6]);
        $collection->flatMap(static fn ($value) => $value);
        $this->assertSame([1, 2, 3, 4, 5, 6], $collection->getValues());
    }

    public function testFlatMapIndexed()
    {
        $collection = Collection::of([1, 2], [3, 4], [5, 6]);
        $collection->flatMapIndexed(static fn ($value, $index) => [...$value, $index]);
        $this->assertSame([1, 2, 0, 3, 4, 1, 5, 6, 2], $collection->getValues());
    }
}
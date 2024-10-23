<?php

declare(strict_types=1);

namespace Xepozz\Kollections\Tests;

use PHPUnit\Framework\TestCase;
use Xepozz\Kollections\Collection;

class SortTest extends TestCase
{
    public function testSort(): void
    {
        $collection = Collection::of(3, 1, 2, 5, 4);
        $collection->sort(static fn ($a, $b) => $a <=> $b);
        $this->assertSame([1, 2, 3, 4, 5], $collection->getValues());
    }

    public function testSortKeys(): void
    {
        $collection = Collection::from(['c' => 1, 'b' => 2, 'a' => 4, 'd' => 1]);
        $collection->sortKeys(static fn ($a, $b) => $a <=> $b);
        $this->assertSame(['a' => 4, 'b' => 2, 'c' => 1, 'd' => 1], $collection->getValues());
    }

    public function testSortByKeys(): void
    {
        $collection = Collection::from(['c' => 1, 'b' => 2, 'a' => 4, 'd' => 1]);
        $collection->sortByKeys();
        $this->assertSame(['a' => 4, 'b' => 2, 'c' => 1, 'd' => 1], $collection->getValues());
    }

    public function testSortByValues(): void
    {
        $collection = Collection::from(['c' => 1, 'b' => 2, 'a' => 4, 'd' => 1]);
        $collection->sortByValues();
        $this->assertSame(['c' => 1, 'd' => 1, 'b' => 2, 'a' => 4], $collection->getValues());
    }


    public function testSortAsNumeric(): void
    {
        $collection = Collection::of('100', '101', '120', '1111');
        $collection->sortAsNumeric();
        $this->assertSame(['100', '101', '120', '1111'], $collection->getValues());
    }

    public function testSortAsNatural(): void
    {
        $collection = Collection::of('100', '101', '120', '1111');
        $collection->sortAsNatural();
        $this->assertSame(['100', '101', '120', '1111'], $collection->getValues());
    }

    public function testSortAsStrings(): void
    {
        $collection = Collection::of('100', '101', '120', '1111');
        $collection->sortAsString();
        $this->assertSame([0 => '100', 1 => '101', 3 => '1111', 2 => '120'], $collection->getValues());
    }

    public function testShuffle(): void
    {
        $values = range(1, 10000);
        $collection = Collection::from($values);
        $collection->shuffle();
        $this->assertNotSame($values, $collection->getValues());
    }

    public function testReverse(): void
    {
        $collection = Collection::from(['a', 'b', 2 => 'c']);
        $collection->reverse();
        $this->assertSame([2 => 'c', 1 => 'b', 0 => 'a'], $collection->getValues());
    }

}
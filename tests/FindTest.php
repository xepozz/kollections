<?php

declare(strict_types=1);

namespace Xepozz\Kollections\Tests;

use PHPUnit\Framework\TestCase;
use Xepozz\Kollections\Collection;

class FindTest extends TestCase
{
    public function testFindFirst()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $this->assertSame(2, $collection->findFirst(static fn ($value) => $value % 2 === 0));
        $this->assertSame(null, $collection->findFirst(static fn ($value) => $value === 10));
    }

    public function testFindLast()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $this->assertSame(4, $collection->findLast(static fn ($value) => $value % 2 === 0));
        $this->assertSame(null, $collection->findLast(static fn ($value) => $value === 10));
    }

    public function testFindFirstKey()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $this->assertSame(1, $collection->findFirstKey(static fn ($value) => $value % 2 === 0));
        $this->assertSame(null, $collection->findFirstKey(static fn ($value) => $value === 10));
    }

    public function testFindLastKey()
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $this->assertSame(3, $collection->findLastKey(static fn ($value) => $value % 2 === 0));
        $this->assertSame(null, $collection->findLastKey(static fn ($value) => $value === 10));
    }
}
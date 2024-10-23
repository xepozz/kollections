<?php

declare(strict_types=1);

namespace Xepozz\Kollections\Tests;

use PHPUnit\Framework\TestCase;
use Xepozz\Kollections\Collection;

class CollectionTest extends TestCase
{
    public function testOf(): void
    {
        $collection = Collection::of(1, 2, 3);
        $this->assertSame([1, 2, 3], $collection->getValues());
    }

    public function testFrom(): void
    {
        $collection = Collection::from([2 => 1, 2, 3]);
        $this->assertSame([2 => 1, 3 => 2, 4 => 3], $collection->getValues());
    }

    public function testToArray(): void
    {
        $collection = Collection::from([2 => 1, 2, 3]);
        $this->assertSame([0 => 1, 1 => 2, 2 => 3], $collection->toArray());
    }

}
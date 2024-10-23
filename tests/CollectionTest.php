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
        $collection = Collection::from([1, 2, 3]);
        $this->assertSame([1, 2, 3], $collection->getValues());
    }
}
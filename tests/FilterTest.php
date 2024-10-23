<?php

declare(strict_types=1);

namespace Xepozz\Kollections\Tests;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use stdClass;
use Xepozz\Kollections\Collection;

class FilterTest extends TestCase
{
    public function testFilter(): void
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $collection->filter(static fn ($value) => $value % 2 === 0);
        $this->assertSame([1 => 2, 3 => 4], $collection->getValues());
    }

    public function testFilterKeys(): void
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $collection->filterKeys(static fn ($key) => $key % 2 === 0);
        $this->assertSame([0 => 1, 2 => 3, 4 => 5], $collection->getValues());
    }

    public function testFilterNot(): void
    {
        $collection = Collection::of(1, 2, 3, 4, 5);
        $collection->filterNot(static fn ($value) => $value % 2 === 0);
        $this->assertSame([0 => 1, 2 => 3, 4 => 5], $collection->getValues());
    }

    public function testFilterNotNull(): void
    {
        $collection = Collection::of(1, null, 3, null, 5);
        $collection->filterNotNull();
        $this->assertSame([0 => 1, 2 => 3, 4 => 5], $collection->getValues());
    }

    public function testFilterNull(): void
    {
        $collection = Collection::of(1, null, 3, null, 5);
        $collection->filterNull();
        $this->assertSame([1 => null, 3 => null], $collection->getValues());
    }

    public function testFilterStrings(): void
    {
        $collection = Collection::of('foo', 42, 'bar', 1337, 'baz');
        $collection->filterStrings();
        $this->assertSame([0 => 'foo', 2 => 'bar', 4 => 'baz'], $collection->getValues());
    }

    public function testFilterIntegers(): void
    {
        $collection = Collection::of('foo', 42, 'bar', 1337, 'baz');
        $collection->filterIntegers();
        $this->assertSame([1 => 42, 3 => 1337], $collection->getValues());
    }

    public function testFilterFloats(): void
    {
        $collection = Collection::of(1.23, 42, 3.14, 1337, 2.71);
        $collection->filterFloats();
        $this->assertSame([0 => 1.23, 2 => 3.14, 4 => 2.71], $collection->getValues());
    }

    public function testFilterBooleans(): void
    {
        $collection = Collection::of(true, 42, false, 1337, true);
        $collection->filterBooleans();
        $this->assertSame([0 => true, 2 => false, 4 => true], $collection->getValues());
    }

    public function testFilterArrays(): void
    {
        $collection = Collection::of([1, 2], 42, [3, 4], 1337, [5, 6]);
        $collection->filterArrays();
        $this->assertSame([0 => [1, 2], 2 => [3, 4], 4 => [5, 6]], $collection->getValues());
    }

    public function testFilterCallable(): void
    {
        $collection = Collection::of(1, 2, $c1 = static fn () => 3, 4, $c2 = static fn () => 5);
        $collection->filterCallables();
        $this->assertSame([2 => $c1, 4 => $c2], $collection->getValues());
    }

    public function testFilterObjects(): void
    {
        $collection = Collection::of($o1 = new stdClass(), 42, $o2 = new stdClass(), 1337);
        $collection->filterObjects();
        $this->assertSame([0 => $o1, 2 => $o2], $collection->getValues());
    }

    public function testFilterScalars(): void
    {
        $collection = Collection::of('foo', 42, 3.14, true, null);
        $collection->filterScalars();
        $this->assertSame([0 => 'foo', 1 => 42, 2 => 3.14, 3 => true], $collection->getValues());
    }


    public function testFilterInstanceOf(): void
    {
        $collection = Collection::of('foo', $d1 = new DateTime(), $d2 = new DateTimeImmutable());
        $collection->filterInstanceOf(DateTimeInterface::class);
        $this->assertSame([1 => $d1, 2 => $d2], $collection->getValues());
    }

    public function testFilterNotInstanceOf(): void
    {
        $collection = Collection::of('foo', $d1 = new DateTime(), $d2 = new DateTimeImmutable());
        $collection->filterNotInstanceOf(DateTime::class);
        $this->assertSame([0 => 'foo', 2 => $d2], $collection->getValues());
    }


}
<?php
/**
 * This file is part of the Lixue package.
 *
 * (c) www.lixueweb.com
 *
 * @since 1.0
 * @author Hylin Yin <hylin@lixueweb.com>
 */

namespace MiniUtils\Tests;

use MiniUtils\MuArray;
use PHPUnit\Framework\TestCase;

class MuArrayTest extends TestCase
{
    public function testKeyMap()
    {
        $array = ['foo', 'bar'];
        MuArray::keyMap($array, function ($val, $key) {
            return $val . $key;
        });
        $this->assertEquals($array, ['foo0' => 'foo', 'bar1' => 'bar']);

        $array = ['foo', 'bar'];
        MuArray::keyMap($array, function (&$val, $key) {
            $val = $val . 'bar';
            return $key;
        });
        $this->assertEquals($array, ['foobar', 'barbar']);
    }

    /**
     * @param array $expected
     * @param array $array1
     * @param array ...$array2
     *
     * @dataProvider mergeProvider
     */
    public function testMerge($expected, $array1, ...$array2)
    {
        MuArray::merge($array1, ...$array2);
        $this->assertEquals($expected, $array1);
    }

    public function mergeProvider()
    {
        return [
            [
                ['foo', 'bar'],
                ['foo'],
                ['bar'],
            ],
            [
                ['foo', 'bar'],
                [2 => 'foo'],
                [3 => 'bar'],
            ],
            [
                ['bar' => 'foo', 'foo' => 'foobar'],
                ['bar' => 'bar'],
                ['bar' => 'foo', 'foo' => 'foobar'],
            ],
            [
                ['bar' => 'barfoo', 'foo' => 'foobar', 'foobar' => 'foobar'],
                ['bar' => 'bar'],
                ['bar' => 'foo', 'foo' => 'foobar'],
                ['bar' => 'barfoo', 'foobar' => 'foobar'],
            ],
        ];
    }

    /**
     * @param array $expected
     * @param array $array
     * @param string $key
     * @param int $order
     * @param bool $maintainIndex
     *
     * @dataProvider multiSortProvider
     */
    public function testMultiSort($expected, $array, $key, $order = SORT_ASC, $maintainIndex = false)
    {
        MuArray::multiSort($array, $key, $order, $maintainIndex);
        $this->assertEquals($expected, $array);
    }

    public function multiSortProvider()
    {
        return [
            [[
                ['name' => 'foobar', 'age' => 3],
                ['name' => 'foo', 'age' => 5],
                ['name' => 'bar', 'age' => 6],
            ], [
                ['name' => 'foo', 'age' => 5],
                ['name' => 'bar', 'age' => 6],
                ['name' => 'foobar', 'age' => 3],
            ], 'age'],
            [[
                ['name' => 'bar', 'age' => 6],
                ['name' => 'foo', 'age' => 5],
                ['name' => 'foobar', 'age' => 3],
            ], [
                ['name' => 'foo', 'age' => 5],
                ['name' => 'bar', 'age' => 6],
                ['name' => 'foobar', 'age' => 3],
            ], 'age', SORT_DESC],
            [[
                1 => ['name' => 'bar', 'age' => 6],
                0 => ['name' => 'foo', 'age' => 5],
                2 => ['name' => 'foobar', 'age' => 3],
            ], [
                ['name' => 'foo', 'age' => 5],
                ['name' => 'bar', 'age' => 6],
                ['name' => 'foobar', 'age' => 3],
            ], 'age', SORT_DESC, true],
            [[
                1 => ['name' => 'bar', 'age' => 6],
                0 => ['name' => 'foo', 'age' => 5],
                2 => ['name' => 'foobar', 'age' => 3],
                3 => ['name' => 'barfoo', 'age' => 3],
            ], [
                ['name' => 'foo', 'age' => 5],
                ['name' => 'bar', 'age' => 6],
                ['name' => 'foobar', 'age' => 3],
                ['name' => 'barfoo', 'age' => 3],
            ], 'age', SORT_DESC, true],
        ];
    }
}
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
}
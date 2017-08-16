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

use MiniUtils\Arr;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    public function testKeyMap()
    {
        $array = ['foo', 'bar'];
        Arr::keyMap($array, function ($val, $key) {
            return $val . $key;
        });
        $this->assertEquals($array, ['foo0' => 'foo', 'bar1' => 'bar']);

        $array = ['foo', 'bar'];
        Arr::keyMap($array, function (&$val, $key) {
            $val = $val . 'bar';
            return $key;
        });
        $this->assertEquals($array, ['foobar', 'barbar']);
    }
}
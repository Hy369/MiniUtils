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

use MiniUtils\MuDate;
use PHPUnit\Framework\TestCase;

class MuDateTest extends TestCase
{
    /**
     * @param int $timestamp
     * @param int $minTime
     * @param string $expected
     *
     * @dataProvider timestampToUtcProvider
     */
    public function testTimestampToUtc($timestamp, $minTime, $expected)
    {
        $this->assertEquals($expected, MuDate::timestampToUtc($timestamp, $minTime));
    }

    public function timestampToUtcProvider()
    {
        return [
            [0, 0, '1970-01-01T00:00:00Z'],
            [0, 1, ''],
            [0, false, '1970-01-01T00:00:00Z'],
            ['foo', false, ''],
            ['1', false, '1970-01-01T00:00:01Z'],
            ['-1', false, '1969-12-31T23:59:59Z'],
        ];
    }
}
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

use MiniUtils\MuString;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testUtf8ToUnicode()
    {
        $this->assertEquals('t', MuString::utf8ToUnicode('t'));
        $this->assertEquals((string)dechex(ord('t')), MuString::utf8ToUnicode('t', '', '', false));
        $this->assertEquals('\u4e00', MuString::utf8ToUnicode('一'));
        $this->assertEquals('\x{4e00}', MuString::utf8ToUnicode('一', '\x{', '}'));
        $this->assertEquals('\u9fa5', MuString::utf8ToUnicode('龥'));
        $this->assertEquals('a\u4e003\u9fa5*', MuString::utf8ToUnicode('a一3龥*'));
    }

    public function testUnicodeToUtf8()
    {
        $this->assertEquals('一', MuString::unicodeToUtf8('\u4e00'));
        $this->assertEquals('1', MuString::unicodeToUtf8('1'));
        $this->assertEquals('~', MuString::unicodeToUtf8('\u7e'));
        $this->assertEquals('1一', MuString::unicodeToUtf8('1\u4e00'));
        $this->assertEquals('1一', MuString::unicodeToUtf8('1\x{4e00}', '\x{', '}'));
        $this->assertEquals('生', MuString::unicodeToUtf8('&#29983;', '&#', ';'));
    }

    public function testReplaceSuffix()
    {
        $this->assertEquals('hylin.doc', MuString::replaceSuffix('hylin.txt', '.doc'));
        $this->assertEquals('hylin.doc', MuString::replaceSuffix('hylin', '.doc'));
        $this->assertEquals('hylin.yin.doc', MuString::replaceSuffix('hylin.yin.txt', '.doc'));
        $this->assertEquals('hylin.doc.doc', MuString::replaceSuffix('hylin.doc.txt', '.doc'));
    }

    /**
     * @param $string
     * @param $withDot
     * @param $expected
     *
     * @dataProvider getSuffixProvider
     */
    public function testGetSuffix($string, $withDot, $expected)
    {
        $this->assertEquals($expected, MuString::getSuffix($string, $withDot));
    }

    public function getSuffixProvider()
    {
        return [
            ['foo.bar', false, 'bar'],
            ['foo.bar', true, '.bar'],
            ['foo', false, ''],
            ['foo', true, ''],
            ['foo.bar.foobar', true, '.foobar'],
        ];
    }
}
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

use MiniUtils\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testUtf8ToUnicode()
    {
        $this->assertEquals('t', Str::utf8ToUnicode('t'));
        $this->assertEquals((string)dechex(ord('t')), Str::utf8ToUnicode('t', '', '', false));
        $this->assertEquals('\u4e00', Str::utf8ToUnicode('一'));
        $this->assertEquals('\x{4e00}', Str::utf8ToUnicode('一', '\x{', '}'));
        $this->assertEquals('\u9fa5', Str::utf8ToUnicode('龥'));
        $this->assertEquals('a\u4e003\u9fa5*', Str::utf8ToUnicode('a一3龥*'));
    }

    public function testUnicodeToUtf8()
    {
        $this->assertEquals('一', Str::unicodeToUtf8('\u4e00'));
        $this->assertEquals('1', Str::unicodeToUtf8('1'));
        $this->assertEquals('1一', Str::unicodeToUtf8('1\u4e00'));
        $this->assertEquals('1一', Str::unicodeToUtf8('1\x{4e00}', '\x{', '}'));
    }
}
<?php
/**
 * This file is part of the MiniUtils package.
 *
 * (c) www.iphp8.com
 *
 * @since 1.0
 * @author Hylin Yin <hylin@iphp8.com>
 */
namespace MiniUtils;

/**
 * 字符串类方法
 *
 * @since 1.0
 * @author Hylin Yin <hylin@iphp8.com>
 */
class Str
{
    /**
     * 转换 UTF-8 为 Unicode 编码
     *
     * @param string $str 需要转码的字符串
     * @param string $prefix 转码字符前缀
     * @param string $suffix 转码字符后缀
     * @param bool $reserveAscii 是否保留 ASCII 编码
     *
     * @return string
     */
    public static function utf8ToUnicode($str, $prefix = '\\u', $suffix = '', $reserveAscii = true)
    {
        $str = str_split($str);
        $result = $temp = '';
        $step = 0;
        foreach ($str as $item) {
            if (ord($item) <= 127 && $reserveAscii) {
                $result .= $item;
                continue;
            }
            $hex = str_pad(decbin(ord($item)), 8, '0', STR_PAD_LEFT);
            $step == 0 && $step = strpos($hex, '0');
            $temp .= ($temp === '' ? substr($hex, $step) : substr($hex, 2));
            $step--;
            if ($step <= 0) {
                $result .= sprintf('%s%s%s', $prefix, str_pad(base_convert($temp, 2, 16), 4, '0', STR_PAD_LEFT), $suffix);
                $temp = '';
            }
        }
        return $result;
    }

    /**
     * 转换 Unicode 为 UTF-8 编码
     *
     * @param string $str 需要转码的字符串
     * @param string $prefix 转码字符前缀
     * @param string $suffix 转码字符后缀
     *
     * @return string
     */
    public static function unicodeToUtf8($str, $prefix = '\\u', $suffix = '')
    {
        $pattern = sprintf('~%s(%s)%s~', addslashes($prefix), '[A-Ea-e\d]+', addslashes($suffix));
        $str = preg_replace_callback($pattern, function ($item) use ($prefix) {
            $bin = base_convert($item[1], $prefix === '&#' ? 10 : 16, 2);
            $group = ceil(strlen($bin) / 6);
            if ($group === 1) {
                return chr($item[1]);
            }
            $bin = str_pad($bin, $group * 6, '0', STR_PAD_LEFT);
            $bins = str_split($bin, 6);
            $result = '';
            foreach ($bins as $key => $val) {
                if ($key === 0) {
                    $tag = str_pad(str_repeat('1', $group), 8, '0');
                } else {
                    $tag = str_pad('1', 8, '0');
                }
                $tag = (int)base_convert($tag, 2, 10);
                $result .= chr(base_convert($val, 2, 10) | $tag);
            }
            return $result;
        }, $str);
        return $str;
    }
}